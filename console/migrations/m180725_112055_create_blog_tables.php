<?php

use yii\db\Migration;

/**
 * Class m180725_112055_create_posts
 */
class m180725_112055_create_blog_tables extends Migration
{

    public function safeUp()
    {
        $this->createTable(
            'post',
            [
                'id'          => $this->primaryKey()->unsigned(),
                'slug'        => $this->string()->notNull(),
                'name'        => $this->string()->notNull(),
                'text'        => $this->text()->notNull(),
                'title'       => $this->string(),
                'keywords'    => $this->string(),
                'description' => $this->string(),
                'author_id'   => $this->integer()->notNull(),
                'image'       => $this->string(),
                'created_at'  => $this->dateTime(),
                'updated_at'  => $this->dateTime(),
                'status'      => $this->smallInteger(1),
                'sort'        => $this->integer(),
            ]
        );

        $this->createTable(
            'tag',
            [
                'id'       => $this->primaryKey()->unsigned(),
                'name'     => $this->string(),
                'sort'     => $this->integer(),
                'language' => $this->string(6)
            ]
        );

        $this->createTable(
            'post_tag',
            [
                'id'      => $this->bigPrimaryKey()->unsigned(),
                'post_id' => $this->integer()->unsigned(),
                'tag_id'  => $this->integer()->unsigned(),
            ]
        );

        $this->createTable(
            'comment',
            [
                'id'         => $this->primaryKey()->unsigned(),
                'author_id'  => $this->integer(),
                'text'       => $this->text(),
                'name'       => $this->string(70),
                'email'      => $this->string(70),
                'accept'     => $this->smallInteger(1),
                'post_id'    => $this->integer()->unsigned(),
                'parent_id'  => $this->integer()->unsigned(),
                'created_at' => $this->dateTime(),
            ]
        );

        $this->createTable('page', [
            'id'          => $this->primaryKey()->unsigned(),
            'slug'        => $this->string(),
            'image'       => $this->string(),
            'name'        => $this->string()->notNull(),
            'text'        => $this->text()->notNull(),
            'title'       => $this->string(),
            'keywords'    => $this->string(),
            'description' => $this->string(),
            'created_at'  => $this->dateTime(),
            'updated_at'  => $this->dateTime(),
        ]);

        $this->addForeignKey('FK_post_author', 'post', 'author_id', 'user', 'id');
        $this->addForeignKey('FK_post_tag_post', 'post_tag', 'post_id', 'post', 'id', 'cascade', 'cascade');
        $this->addForeignKey('FK_post_tag_tag', 'post_tag', 'tag_id', 'tag', 'id', 'cascade', 'cascade');
        $this->addForeignKey('FK_comment_author', 'comment', 'author_id', 'user', 'id');
        $this->addForeignKey('FK_comment_post', 'comment', 'post_id', 'post', 'id');

        $this->createIndex('I_post_author', 'post', 'author_id');
        $this->createIndex('I_tag_lang', 'tag', 'language');
        $this->createIndex('U_tag_name', 'tag', 'name', true);
        $this->createIndex('U_post_slug', 'post', 'slug', true);

        $this->insert('module', ['name' => 'blog', 'title' => 'Блог']);

        $id = $this->db->createCommand("SELECT id FROM module WHERE name='blog'")->queryScalar();
        $blogModules = [
            ['post', 'Статьи', $id],
            ['page', 'Страницы', $id],
        ];
        $this->batchInsert('module', ['name', 'title', 'parent_id'], $blogModules);
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_post_tag_tag', 'post_tag');
        $this->dropForeignKey('FK_post_tag_post', 'post_tag');
        $this->dropForeignKey('FK_post_author', 'post');
        $this->dropForeignKey('FK_comment_author', 'comment');
        $this->dropForeignKey('FK_comment_post', 'comment');

        $this->dropTable('page');
        $this->dropTable('comment');
        $this->dropTable('post_tag');
        $this->dropTable('tag');
        $this->dropTable('post');
    }
}
