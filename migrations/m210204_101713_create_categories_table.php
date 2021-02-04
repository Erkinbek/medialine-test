<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m210204_101713_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
	        'title' => $this->string(255)->notNull(),
	        'parent_id' => $this->integer(),
	        'created_at' => $this->dateTime()->defaultExpression("NOW()"),
	        'updated_at' => $this->dateTime()
        ]);

        $this->addForeignKey(
        	'fk-parent-category',
	        'categories',
	        'parent_id',
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
        $this->dropTable('{{%categories}}');
    }
}
