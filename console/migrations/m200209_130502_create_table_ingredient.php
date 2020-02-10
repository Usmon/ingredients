<?php

use yii\db\Migration;

/**
 * Class m200209_130502_create_table_ingredient
 */
class m200209_130502_create_table_ingredient extends Migration
{

    /**
     * Name of table
     * @string
     */
    public static $TB_NAME = 'ingredients';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::$TB_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'active' => $this->boolean(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::$TB_NAME);

        echo "m200209_130502_create_table_ingredient cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200209_130502_create_table_ingredient cannot be reverted.\n";

        return false;
    }
    */
}
