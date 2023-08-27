<?php

use yii\db\Migration;

/**
 * Class m230827_030651_create_table_users
 */
class m230827_030651_create_table_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(255),
            'created_at'=>$this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230827_030651_create_table_users cannot be reverted.\n";

        return false;
    }
    */
}
