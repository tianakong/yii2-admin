<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user_role}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $role_id
 */
class UserRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'role_id'], 'integer'],
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
            'role_id' => '角色ID',
        ];
    }

    /**
     * 获取用户的角色名称
     * @param $userId
     * @return string
     */
    public static function getUserRoleNames($userId)
    {
        $roleIds = UserRole::find()->select('role_id')->where(['user_id'=>$userId])->asArray()->column();
        $roleNames = Role::find()->select('name')->where(['id'=>$roleIds])->asArray()->column();
        return implode(',', $roleNames);
    }

    /**
     * 获取用户的角色id
     * @param $userId
     * @return array
     */
    public static function getUserRoleids($userId)
    {
        return UserRole::find()->select('role_id')->where(['user_id'=>$userId])->asArray()->column();
    }
}
