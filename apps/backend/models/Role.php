<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%role}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $remarks
 */
class Role extends \yii\db\ActiveRecord
{
    public $priv;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required', 'message' => '角色名称不可以为空'],
            [['name'], 'string', 'max' => 20],
            [['remarks'], 'string', 'max' => 255],
            ['priv', 'string', 'max' => 5000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '角色名称',
            'remarks' => '备注',
        ];
    }

    /**
     * 添加用户选择角色
     * @return array
     */
    public static function getIds()
    {
        return self::find()->select('name')->indexBy('id')->column();
    }

    /**
     * 添加角色
     * @return bool
     */
    public function addData()
    {
        if (!$this->validate()) {
            return false;
        }
        $this->save(false);

        if ($this->priv) {
            $this->setPriv($this->priv);
        }

        return true;
    }

    /**
     * 设置角色权限
     * @param $priv
     */
    protected function setPriv($priv)
    {
        $authModel = new Auth();
        $authModel->deleteAll(['role_id' => $this->id]);
        $privArr = explode(',', $priv);
        foreach ($privArr as $menu_id) {
            $authModels = clone $authModel;
            $authModels->role_id = $this->id;
            $authModels->menu_id = $menu_id;
            $authModels->save();
        }
    }

}
