<?php

use yii\db\Migration;

/**
 * Class m230827_060444_rbac_init
 */
class m230827_060444_rbac_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $manageArticles = $auth->createPermission('manageArticles');
        $manageArticles->description = 'Manage articles';
        $auth->add($manageArticles);

        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Manage users';
        $auth->add($manageUsers);

        $moderator = $auth->createRole('moderator');
        $moderator->description = 'Moderator';
        $auth->add($moderator);
        $auth->addChild($moderator, $manageArticles);

        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator';
        $auth->add($admin);
        $auth->addChild($admin, $moderator);
        $auth->addChild($admin, $manageUsers);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->authManager->removeAll();


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230827_060444_rbac_init cannot be reverted.\n";

        return false;
    }
    */
}
