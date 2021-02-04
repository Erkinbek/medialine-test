<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article_mapping}}`.
 */
class m210204_101729_create_article_mapping_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article_mapping}}', [
            'id' => $this->primaryKey(),
	        'article_id' => $this->integer()->notNull(),
	        'category_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
        	'fk-article-map',
	        'article_mapping',
	        'article_id',
	        'articles',
	        'id',
	        'CASCADE',
	        'NO ACTION'
        );

	    $this->addForeignKey(
		    'fk-category-map',
		    'article_mapping',
		    'category_id',
		    'categories',
		    'id',
		    'CASCADE',
		    'NO ACTION'
	    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article_mapping}}');
    }
}
