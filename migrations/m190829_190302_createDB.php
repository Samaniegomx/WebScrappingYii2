<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190829_190302_createDB
 */
class m190829_190302_createDB extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('tblProductos', [
            'id' => 'pk',
            'idProducto' => Schema::TYPE_STRING . ' NOT NULL',
            'nombre' => Schema::TYPE_TEXT,
            'precio' => Schema::TYPE_DECIMAL,
            'descripcion' => Schema::TYPE_TEXT
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('tblProductos');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190829_190302_createDB cannot be reverted.\n";

        return false;
    }
    */
}
