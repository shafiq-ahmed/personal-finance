<?php

use yii\db\Migration;

/**
 * Class m230824_101943_first_migration
 */
class m230824_101943_first_migration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(255),
            'username'=>$this->string()->unique()->notNull(),
            'password'=>$this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230824_101943_first_migration cannot be reverted.\n";

        return false;
    }
    */
}
