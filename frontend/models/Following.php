<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "following".
 *
 * @property int $id
 * @property string $screen_name
 */
class Following extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'following';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['screen_name'], 'required'],
            [['screen_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'screen_name' => '@Screen_Name',
        ];
    }
}
