<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $phone
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * 添加用户密码
     * @var
     */
    public $password;

    /**
     * 添加用户选择的角色ID
     * @var
     */
    public $roleIds;

    /**
     * 添加用户选择的站点ID
     * @var
     */
    public $webIds;

    /**
     * 添加用户状态选项
     * @var array
     */
    public static $statusOption = [
        '1' => '启用',
        '0' => '禁用',
    ];

    /**
     * 列表状态显示
     * @var array
     */
    public static $statusShow = [
        '0' => '<span class="no"><i class="fa fa-ban"></i> 禁用</span>',
        '1' => '<span class="yes" style="color:#1BBC9D;"><i class="fa fa-check-circle"></i> 启用</span>',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /*public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['password'];
        return $scenarios;
    }*/

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['roleIds', 'required', 'message' => '必须选中一个角色'],
            ['webIds', 'required', 'message' => '必须选中一个站点'],
            ['username', 'filter', 'filter' => 'trim'],
            // required表示必须的，也就是说表单提交过来的值必须要有, message 是username不满足required规则时给的提示消息
            ['username', 'required', 'message' => '用户名不可以为空'],
            // unique表示唯一性，targetClass表示的数据模型 这里就是说UserBackend模型对应的数据表字段username必须唯一
            ['username', 'unique', 'targetClass' => '\backend\models\User', 'message' => '用户名已存在.'],
            // string 字符串，这里我们限定的意思就是username至少包含6个字符，最多50个字符
            ['username', 'string', 'min' => 5, 'max' => 50, 'message' => '用户名至少包含5个字符，最多50个字符'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => '邮箱不可以为空'],
            ['email', 'email', 'message' => '邮箱格式不正确'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'email已经被设置了.'],
            ['password', 'required', 'message' => '密码不可以为空', 'on' => 'create'],
            ['password', 'string', 'min' => 6, 'tooShort' => '密码至少填写6位'],
            [['phone','password','roleIds', 'webIds'], 'string'],
            // default 默认在没有数据的时候才会进行赋值
            [['created_at', 'updated_at'], 'default', 'value' => date('Y-m-d H:i:s')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'phone' => '联系手机号',
            'email' => 'Email',
            'created_at' => '创建时间',
            'updated_at' => 'Updated At',
            'status' => '状态', //：0禁用，1启用
        ];
    }

    /**
     * 关联用户-角色表关系
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(UserRole::className(), ['user_id' => 'id']);
    }

    /**
     * 添加用户.
     *
     * @return true|false 添加成功或者添加失败
     */
    public function addData()
    {
        $this->roleIds = $this->roleIds ? json_encode($this->roleIds) : null;
        $this->webIds = $this->webIds ? json_encode($this->webIds) : null;
        // 调用validate方法对表单数据进行验证，验证规则参考上面的rules方法
        if (!$this->validate()) {
            return false;
        }
        if ($this->password) {
            $this->setPassword($this->password);
        }
        // 生成 "remember me" 认证key
        $this->generateAuthKey();

        $this->save(false);

        if ($this->roleIds) {
            $this->roleIds = json_decode($this->roleIds, true);
            $this->setRole($this->roleIds, $this->id);
        }
        if ($this->webIds) {
            $this->webIds = json_decode($this->webIds, true);
            $this->setWeb($this->webIds, $this->id);
        }

        return true;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * 设置用户的角色
     * @param $roleIds
     * @param $userId
     */
    public function setRole($roleIds, $userId)
    {
        $model = new UserRole();
        $model->deleteAll(['user_id' => $userId]);
        if (is_array($roleIds)) {
            foreach ($roleIds as $roleId) {
                if (!is_numeric($roleId)) {
                    continue;
                }
                $userRoleModel = clone $model;
                $userRoleModel->user_id = $userId;
                $userRoleModel->role_id = $roleId;
                $userRoleModel->save();
            }
        } else if (is_numeric($roleIds)) {
            $userRoleModel = clone $model;
            $userRoleModel->user_id = $userId;
            $userRoleModel->role_id = $roleIds;
            $userRoleModel->save();
        }
    }

    /**
     * 设置用户的管理站点
     * @param $webIds
     * @param $userId
     */
    public function setWeb($webIds, $userId)
    {
        $model = new UserWeb();
        $model->deleteAll(['user_id' => $userId]);
        if (is_array($webIds)) {
            foreach ($webIds as $webId) {
                if (!is_numeric($webId)) {
                    continue;
                }
                $userWebModel = clone $model;
                $userWebModel->user_id = $userId;
                $userWebModel->web_id = $webId;
                $userWebModel->save();
            }
        } else if (is_numeric($webIds)) {
            $userWebModel = clone $model;
            $userWebModel->user_id = $userId;
            $userWebModel->web_id = $webIds;
            $userWebModel->save();
        }
    }
}
