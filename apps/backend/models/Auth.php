<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%auth}}".
 *
 * @property integer $role_id
 * @property integer $menu_id
 */
class Auth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'menu_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => '角色ID',
            'menu_id' => '菜单ID',
        ];
    }

    /**
     * 删除角色的所有权限
     * @param $roleId
     * @return int
     */
    public static function deleteRolePriv($roleId)
    {
        return self::deleteAll(['role_id'=>$roleId]);
    }

    /**
     * 获取用户有权限的路由
     * @param $userId
     * @return array
     */
    public static function getUserPriv($userId)
    {
        $roleIds = UserRole::find()->select('role_id')->where(['user_id'=>$userId])->asArray()->column();
        $menuIds = Auth::find()->select('menu_id')->where(['role_id'=>$roleIds])->asArray()->column();
        $userPriv = Menu::find()->select('route')->indexBy('id')->where(['id'=>$menuIds])->asArray()->column();

        return $userPriv;
    }

    /**
     * 获取用户有权限的菜单ID
     * @param $userId
     * @return array
     */
    public static function getUserMenuIds($userId)
    {
        $roleIds = UserRole::find()->select('role_id')->where(['user_id'=>$userId])->asArray()->column();
        $menuIds = Auth::find()->select('menu_id')->where(['role_id'=>$roleIds])->asArray()->column();

        return $menuIds;
    }
}
