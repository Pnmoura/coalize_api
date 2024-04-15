<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth}}`.
 */
class m240410_135441_create_auth_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('auth', [
            'id' => $this->primaryKey(),
            'cpf' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
        ]);

        // $this->addForeignKey('fk_auth_client', 'auth', 'cpf', 'client', 'cpf', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_auth_client', 'auth');
        $this->dropTable('auth');
    }
}
