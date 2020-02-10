<?php

use yii\db\Migration;

/**
 * Class m200210_125554_create_dishe_ings
 */
class m200210_125554_create_dishe_ings extends Migration
{
    /**
     * Name of table
     * @string
     */
    public static $TB_NAME = 'dishe_ings';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::$TB_NAME, [
            'id' => $this->primaryKey(),
            'id_dish' => $this->integer()->notNull(),
            'id_ing' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-dish_rel-id_dish',
            self::$TB_NAME,
            'id_dish'
        );
        $this->addForeignKey(
            'fk-dish_rel-id_dish',
            self::$TB_NAME,
            'id_dish',
            'dishes',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-dish_rel-id_ing',
            self::$TB_NAME,
            'id_ing'
        );
        $this->addForeignKey(
            'fk-dish_rel-id_ing',
            self::$TB_NAME,
            'id_ing',
            'ingredients',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200210_125554_create_dishe_ings cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200210_125554_create_dishe_ings cannot be reverted.\n";

        return false;
    }
    */
}
