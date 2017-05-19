<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $name
 * @property string $route
 * @property integer $is_show
 * @property string $data
 * @property integer $sort
 * @property integer $level
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * 状态显示
     * @var array
     */
    public static $isShow = [
        '0' => '<span class="no"><i class="fa fa-ban"></i> 否</span>',
        '1' => '<span class="yes" style="color:#1BBC9D;"><i class="fa fa-check-circle"></i> 是</span>',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            ['route', 'filter', 'filter' => 'trim'],
            [['name'], 'required', 'message' => '菜单名不可以为空'],
            [['route'], 'required', 'message' => '菜单路由不可以为空'],
            [['pid', 'is_show', 'sort', 'level'], 'integer', 'message' => '必须为数值'],
            [['name'], 'string', 'max' => 30],
            [['route'], 'string', 'max' => 100],
            [['data'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => '父菜单',
            'name' => '菜单名称',
            'route' => '菜单路由',
            'is_show' => '显示',//是否显示菜单,0不显示，1显示
            'data' => '附加数据',
            'sort' => '排序',
            'level' => '级别',
        ];
    }

    /**
     * 获取菜单列表
     * @return array
     */
    public function getMenuList()
    {
        $data = $this->find()->orderBy(['sort' => SORT_DESC])->asArray()->all();
        return self::rec($data, 0);
    }

    /**
     * 递归出菜单层级
     * @param $arr
     * @param $id
     * @param int $lev
     * @return array
     */
    private static function rec($arr, $id, $lev = 0)
    {
        static $list = array();
        foreach ($arr as $v) {
            if ($v['pid'] == $id) {
                $v['lev'] = $lev;
                $list[] = $v;
                self::rec($arr, $v['id'], $lev + 1);
            }
        }
        return $list;
    }

    /**
     * 获取菜单选项
     * @return array
     */
    public static function getMenuDrop()
    {
        $data = Menu::find()->orderBy(['sort' => SORT_DESC])->asArray()->all();
        $data = self::rec($data, 0);
        $menu = [];
        foreach ($data as $val) {
            $menu[$val['id']] = str_repeat('--', $val['lev']) . $val['name'];
        }
        return $menu;
    }

    /**
     * 获取系统菜单
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getSystemMenu($userId)
    {
        if ($userId == 1) {
            $menuData = Menu::find()->where(['pid' => 0, 'is_show' => 1])->orderBy(['sort' => SORT_DESC])->asArray()->all();
            foreach ($menuData as &$item) {
                $item['child'] = Menu::find()->where(['pid' => $item['id'], 'is_show' => 1])->orderBy(['sort' => SORT_DESC])->asArray()->all();
                if ($item['child']) {
                    foreach ($item['child'] as &$val) {
                        $val['child'] = Menu::find()->where(['pid' => $val['id'], 'is_show' => 1])->orderBy(['sort' => SORT_DESC])->asArray()->all();
                    }
                }
            }
        } else {
            $menuIds = Auth::getUserMenuIds($userId); //根据用的权限加载菜单
            $menuData = Menu::find()->where(['id' => $menuIds, 'pid' => 0, 'is_show' => 1])->orderBy(['sort' => SORT_DESC])->asArray()->all();
            foreach ($menuData as &$item) {
                $item['child'] = Menu::find()->where(['id' => $menuIds, 'pid' => $item['id'], 'is_show' => 1])->orderBy(['sort' => SORT_DESC])->asArray()->all();
                if ($item['child']) {
                    foreach ($item['child'] as &$val) {
                        $val['child'] = Menu::find()->where(['id' => $menuIds, 'pid' => $val['id'], 'is_show' => 1])->orderBy(['sort' => SORT_DESC])->asArray()->all();
                    }
                }
            }
        }

        return $menuData;
    }
}
