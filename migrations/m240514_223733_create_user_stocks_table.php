<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_stocks}}`.
 */
class m240514_223733_create_user_stocks_table extends Migration
{
    /**
     
     
    public function safeUp()
    {
        $this->createTable('{{%user_stocks}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    
    public function safeDown()
    {
        $this->dropTable('{{%user_stocks}}');
    }
    **/
    public function safeUp()
    {
        $this->createTable('user_stocks', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'stock_symbol' => $this->string(10)->notNull(),
            'quantity' => $this->integer()->notNull(),
        ]);

        // Add foreign key constraint
        $this->addForeignKey(
            'fk-user_stocks-user_id',
            'user_stocks',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign key constraint
        $this->dropForeignKey('fk-user_stocks-user_id', 'user_stocks');

        $this->dropTable('user_stocks');
    }
}
