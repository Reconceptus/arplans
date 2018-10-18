<?php

use yii\db\Migration;

/**
 * Class m181017_130126_create_collaboration
 */
class m181017_130126_create_collaboration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $collab = $auth->createPermission('partner_collaboration');
        $collab->description = 'Страница сотрудничества';
        $auth->add($collab);

        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $collab);
        $id = $this->db->createCommand("SELECT id FROM module WHERE name='partner'")->queryScalar();
        $partnerModules = [
            ['collaboration', 'Сотрудничество', $id],
        ];
        $this->batchInsert('module', ['name', 'title', 'parent_id'], $partnerModules);

        $this->addColumn('content_block', 'type', $this->string()->defaultValue(''));
        $this->addColumn('content_block', 'sort', $this->integer()->defaultValue(500));
        $values = [
            ['collaboration', 'Сотрудничество', '/collaboration', 'Заголовок 1', 'collaboration_title_1', '', '', 'string', 1],
            ['collaboration', 'Сотрудничество', '/collaboration', 'Текст 1', 'collaboration_text_1', '', '', 'string', 2],
            ['collaboration', 'Сотрудничество', '/collaboration', 'Картинка 1', 'collaboration_image_1', '', '', 'file', 3],
            ['collaboration', 'Сотрудничество', '/collaboration', 'Заголовок2', 'collaboration_title_2', '', '', 'string', 4],
            ['collaboration', 'Сотрудничество', '/collaboration', 'Текст 2', 'collaboration_text_2', '', '', 'string', 5],
            ['collaboration', 'Сотрудничество', '/collaboration', 'Картинка 2', 'collaboration_image_2', '', '', 'file', 6],
            ['collaboration', 'Сотрудничество', '/collaboration', 'Заголовок 3', 'collaboration_title_3', '', '', 'string', 7],
            ['collaboration', 'Сотрудничество', '/collaboration', 'Текст 3', 'collaboration_text_3', '', '', 'string', 8],
            ['collaboration', 'Сотрудничество', '/collaboration', 'Картинка 3', 'collaboration_image_3', '', '', 'file', 9],
            ['collaboration', 'Сотрудничество', '/collaboration', 'Менеджер', 'collaboration_manager', '', '', 'int', 10],
        ];
        Yii::$app->db->createCommand()->batchInsert('content_block', ['page', 'page_title', 'page_url', 'name', 'slug', 'text', 'language', 'type', 'sort'], $values)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181017_130126_create_collaboration cannot be reverted.\n";

        return false;
    }
    */
}
