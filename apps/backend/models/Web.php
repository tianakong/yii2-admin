<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%web}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $status
 */
class Web extends \yii\db\ActiveRecord
{
    /**
     * 状态:0禁用，1启用
     * @var array
     */
    public static $statusShow = [
        '0' => '<span class="no"><i class="fa fa-ban"></i> 禁用</span>',
        '1' => '<span class="yes" style="color:#1BBC9D;"><i class="fa fa-check-circle"></i> 启用</span>',
    ];

    /**
     * 添加 状态:0禁用，1启用
     * @var array
     */
    public static $statusOption = [
        '1' => '启用',
        '0' => '禁用',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%web}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required', 'message' => '请填写站点名称'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['url'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '网站名称',
            'url' => '域名网站',
            'status' => '状态',
        ];
    }

    /**
     * 添加用户选择站点
     * @return array
     */
    public static function getIds()
    {
        return self::find()->select('name')->indexBy('id')->column();
    }
}
