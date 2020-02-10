<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "ingredients".
 *
 * @property int $id
 * @property string|null $name
 * @property bool|null $active
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Ingredients extends \yii\db\ActiveRecord
{
    /**
     * Status active
     */
    public static $IS_ACTIVE = 1;

    /**
     * Status no active
     */
    public static $IS_DISABLED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredients';
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
            ['active', 'boolean'],
            ['active', 'default', 'value' => self::$IS_ACTIVE],
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
}
