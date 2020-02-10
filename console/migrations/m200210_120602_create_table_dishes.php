<?php

use yii\db\Migration;

/**
 * Class m200210_120602_create_table_dishes
 */
class m200210_120602_create_table_dishes extends Migration
{
    /**
     * Name of table
     * @string
     */
    public static $TB_NAME = 'dishes';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::$TB_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
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

        echo "m200210_120602_create_table_dishes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200210_120602_create_table_dishes cannot be reverted.\n";

        return false;
    }
    */
}
