<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class mYYYYmmdd_HHmmss_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'client_id' => $this->integer(),
            'photo' => $this->string(),
            // Adicione outras colunas conforme necessário
        ]);

        // Adicione chave estrangeira, se aplicável
        $this->addForeignKey(
            'fk-product-client_id',
            'product',
            'client_id',
            'client', // Nome da tabela de clientes
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product');
    }
}
