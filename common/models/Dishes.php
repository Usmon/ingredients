<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "dishes".
 *
 * @property int $id
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property DisheIngs[] $disheIngs
 */
class Dishes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dishes';
    }

    /**
     * Behaviors
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[DisheIngs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisheIngs()
    {
        return $this->hasMany(DisheIngs::className(), ['id_dish' => 'id']);
    }

    /**
     * Create sub items
     *
     * @param array $ingredients
     */
    public function createItems(array $ingredients)
    {
        foreach ($ingredients as $item) {
            $sub_item = new DisheIngs([
                'id_dish' => $this->primaryKey,
                'id_ing' => $item
            ]);
            $sub_item->save();
        }
    }
}
