<?php

use yii\db\Migration;

/**
 * Class m180815_130533_create_blog_permissions
 */
class m180725_122222_create_blog_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // создать разрешения
        $blog = $auth->createPermission('blog');
        $blog->description = 'Доступ к админке блога';
        $auth->add($blog);

        $posts = $auth->createPermission('blog_post');
        $posts->description = 'Посты';
        $auth->add($posts);

        $pages = $auth->createPermission('blog_page');
        $pages->description = 'Страницы';
        $auth->add($pages);

        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $blog);
        $auth->addChild($admin, $posts);
        $auth->addChild($admin, $pages);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

}
