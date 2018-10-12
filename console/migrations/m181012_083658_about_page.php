<?php

use yii\db\Migration;

/**
 * Class m181012_083658_about_page
 */
class m181012_083658_about_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $about = $auth->createPermission('partner_about');
        $about->description = 'Управление информацией компании';
        $auth->add($about);

        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $about);

        $id = $this->db->createCommand("SELECT id FROM module WHERE name='partner'")->queryScalar();
        $partnerModules = [
            ['about', 'Наша компания', $id],
        ];
        $this->batchInsert('module', ['name', 'title', 'parent_id'], $partnerModules);

        $this->createTable('about_benefit', [
            'id'   => $this->primaryKey()->unsigned(),
            'name' => $this->string(),
            'text' => $this->string(500)
        ]);

        $this->createTable('about_ready', [
            'id'   => $this->primaryKey()->unsigned(),
            'name' => $this->string(),
            'file' => $this->string()
        ]);

        $this->createTable('reviews', [
            'id'            => $this->primaryKey()->unsigned(),
            'author_name'   => $this->string(),
            'author_email'  => $this->string(),
            'author_status' => $this->string(),
            'text'          => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('about_benefit');
        $this->dropTable('about_ready');
    }
}
