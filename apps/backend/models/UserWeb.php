<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user_web}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $web_id
 */
class UserWeb extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_web}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'web_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'web_id' => '站点ID',
        ];
    }

    /**
     * 获取用户的站点id
     * @param $userId
     * @return array
     */
    public static function getUserWebids($userId)
    {
        return UserWeb::find()->select('web_id')->where(['user_id'=>$userId])->asArray()->column();
    }
}
