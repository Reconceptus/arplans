<?php

use yii\db\Migration;

/**
 * Class m181024_131503_add_main_page_content
 */
class m181024_131503_add_main_page_content extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $values = [
            ['main', 'Главная', '/', 'Текст на главной', 'main_page_text', ' <p>Мы — архитектурное бюро Арпланс и мы знаем все о строительстве домов в России, за 10 лет по
                            нашим проектам построено более 2000 домов. Наши дома комфортны, а проекты созданы с учетом
                            современного строительно рынка России. Мы растем и становимся доступнее — более 300
                            профессиональных готовых проектов на сайте.</p>
                        <p>Мы благодарны нашим клиентам за отзывы и рекомендации, вы даете нам самый мощный импульс для
                            творчества! </p>', ''],
            ['main', 'Главная', '/', 'Автор текста на главной', 'main_page_author', '<p>Петр Васильевич,</p>
                        <p>руководитель</p>', ''],
        ];
        Yii::$app->db->createCommand()->batchInsert('content_block', ['page', 'page_title', 'page_url', 'name', 'slug', 'text', 'language'], $values)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181024_131503_add_main_page_content cannot be reverted.\n";

        return false;
    }
}
