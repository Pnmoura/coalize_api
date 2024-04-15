<?php

use yii\db\Migration;

/**
 * Handles the creation of table `custom_user`.
 */
class mYYYYmmdd_HHmmss_create_custom_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('custom_user', [
            'id' => $this->primaryKey(),
            'cpf' => $this->string()->notNull()->unique(),
            'username' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('custom_user');
    }
}
