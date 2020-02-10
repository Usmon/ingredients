<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dishe_ings".
 *
 * @property int $id
 * @property int $id_dish
 * @property int $id_ing
 *
 * @property Dishes $dish
 * @property Ingredients $ing
 */
class DisheIngs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dishe_ings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_dish', 'id_ing'], 'required'],
            [['id_dish', 'id_ing'], 'integer'],
            [['id_dish'], 'exist', 'skipOnError' => true, 'targetClass' => Dishes::className(), 'targetAttribute' => ['id_dish' => 'id']],
            [['id_ing'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredients::className(), 'targetAttribute' => ['id_ing' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_dish' => 'Id Dish',
            'id_ing' => 'Id Ing',
        ];
    }

    /**
     * Gets query for [[Dish]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dishes::className(), ['id' => 'id_dish']);
    }

    /**
     * Gets query for [[Ing]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIng()
    {
        return $this->hasOne(Ingredients::className(), ['id' => 'id_ing']);
    }
}
