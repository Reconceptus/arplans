<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 25.07.2018
 * Time: 11:09
 */

namespace modules\translate;

use frontend\modules\translate\models\Message;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\i18n\DbMessageSource;
use yii\i18n\MissingTranslationEvent;

class DbMessage extends DbMessageSource
{
	private $_messages = [];

	/**
	 * @param $category
	 * @param $language
	 *
	 * @return array
	 */
	public static function getCacheKey($category, $language)
	{
		return [$category, $language];
	}

	/**
	 * Добавляет или обновляет тексты переводов
	 *
	 * @param       $category
	 * @param       $key
	 * @param array $messages
	 *
	 * @return bool
	 * @throws \yii\base\InvalidConfigException
	 */
	public static function addMessages($category, $key, array $messages)
	{
		$messageSource = \Yii::$app->getI18n()->getMessageSource($category);

		if (!($messageSource instanceof DbMessageSource)) {
			return false;
		}

		$idKeyMessage = (new Query())->select(['id'])
			->from(['t1' => $messageSource->sourceMessageTable])
			->where(
				[
					't1.category' => $category,
					't1.message'  => $key,
				]
			)
			->createCommand($messageSource->db)
			->queryScalar();

		if (!$idKeyMessage) {
			$messageSource->db->createCommand()
				->insert($messageSource->sourceMessageTable, ['category' => $category, 'message' => $key])
				->execute();
			$idKeyMessage = $messageSource->db->getLastInsertID();
		}

		foreach ($messages as $language => $message) {
			$messageSource->db->createCommand(
				"INSERT INTO $messageSource->messageTable (`id`, `language`, `translation`)
				VALUE (:idKeyMessage, :language, :message)
				ON DUPLICATE KEY UPDATE translation = :message",
				[
					':idKeyMessage' => $idKeyMessage,
					':language'     => $language,
					':message'      => $message,
				]
			)->execute();

			if ($messageSource->enableCaching) {
				$cacheKey = self::getCacheKey($category, $language);
				$messageSource->cache->delete($cacheKey);
			}
		}

		return true;
	}

	/**
	 * @param string $category
	 * @param string $keyMessage
	 * @param string $language
	 *
	 * @return bool|string
	 * @throws \yii\db\Exception
	 */
	public function translate($category, $keyMessage, $language)
	{
		// Если нет перевода для текущего языка
		if (!($message = $this->translateMessage($category, $keyMessage, $language))) {
			$message = $this->translateMessage($category, $keyMessage, Message::LANG_RU);
		}

		return $message;
	}

	/**
	 * @param string $category
	 * @param string $keyMessage
	 * @param string $language
	 *
	 * @return bool|string
	 * @throws \yii\db\Exception
	 */
	public function translateMessage($category, $keyMessage, $language)
	{
		$key = $language . '/' . $category;
		if (!isset($this->_messages[$key])) {
			$this->_messages[$key] = $this->loadMessages($category, $language);
		}
		if (isset($this->_messages[$key][$keyMessage]) && $this->_messages[$key][$keyMessage] !== '') {
			return $this->_messages[$key][$keyMessage];
		} elseif ($this->hasEventHandlers(self::EVENT_MISSING_TRANSLATION)) {
			$event = new MissingTranslationEvent([
				'category' => $category,
				'message' => $keyMessage,
				'language' => $language,
			]);
			$this->trigger(self::EVENT_MISSING_TRANSLATION, $event);
			if ($event->translatedMessage !== null) {
				return $this->_messages[$key][$keyMessage] = $event->translatedMessage;
			}
		}

		return $this->_messages[$key][$keyMessage] = false;
	}

	/**
	 * @param string $category
	 * @param string $language
	 *
	 * @return array|bool|mixed
	 * @throws \yii\db\Exception
	 */
	protected function loadMessages($category, $language)
	{
		if ($this->enableCaching) {
			$cacheKey = self::getCacheKey($category, $language);
			$messages = $this->cache->get($cacheKey);
			if ($messages === false) {
				$messages = $this->loadMessagesFromDb($category, $language);
				$this->cache->set($cacheKey, $messages, $this->cachingDuration);
			}

			return $messages;
		} else {
			return $this->loadMessagesFromDb($category, $language);
		}
	}

	/**
	 * @param string $category
	 * @param string $language
	 *
	 * @return array
	 * @throws \yii\db\Exception
	 */
	protected function loadMessagesFromDb($category, $language)
	{
		$mainQuery = (new Query())->select(['key' => 't1.message', 'message' => 't2.translation'])
			->from(['t1' => $this->sourceMessageTable, 't2' => $this->messageTable])
			->where([
				't1.id' => new Expression('[[t2.id]]'),
				't1.category' => $category,
				't2.language' => $language,
			]);

		$messages = $mainQuery->createCommand($this->db)->queryAll();

		return ArrayHelper::map($messages, 'message', 'translation');
	}
}