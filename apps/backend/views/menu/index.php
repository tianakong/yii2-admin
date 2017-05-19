<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginBlock('option'); ?>
<div class="pull-right" style="line-height: 42px;">
    <?= Html::a('添加', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    <a class="btn btn-primary btn-sm" href="javascript:location.replace(location.href);" title="刷新">
        <span class="fa fa-refresh"></span>
    </a>
</div>
<?php $this->endBlock(); ?>
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>菜单管理</h5>&nbsp;&nbsp;<font>(共<?=count($data)?>条记录)</font>
                <div class="ibox-tools">
                    <a style="color:#999;" class="" href="javascript:location.replace(location.href);" title="刷新">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div id="w0" class="grid-view">
                    <div class="table-responsive">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>PID</th>
                            <th>名称</th>
                            <th>路由</th>
                            <th>显示</th>
                            <th>排序</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $key=>$val):?>
                        <tr data-key="<?=$val['id'];?>">
                            <td><?=$key?></td>
                            <td><?=$val['id'];?></td>
                            <td><?=$val['pid'];?></td>
                            <td class="text-l">
                                <?php if($val['lev']==0)echo '├';?>
                                <?php if($val['lev']==1)echo '&nbsp;&nbsp;&nbsp;│';?>
                                <?php if($val['lev']==2)echo '&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;└ ';?>
                                <?=$val['name'];?>
                            </td>
                            <td class="text-l"><?=$val['route'];?></td>
                            <td class="text-c">
                                <?=\backend\models\Menu::$isShow[$val['is_show']]?>
                            </td>
                            <td><?=$val['sort'];?></td>
                            <td>
                                <a class="btn btn-xs btn-outline btn-default" href="<?=Url::to(['menu/view?id='.$val['id']])?>" title="查看">查看</a>
                                <a class="btn btn-xs btn-outline btn-success" href="<?=Url::to(['menu/update?id='.$val['id']])?>" title="栏目信息">编辑</a>
                                <a class="btn btn-xs btn-outline btn-danger" href="<?=Url::to(['menu/delete?id='.$val['id']])?>" title="删除" data-confirm="确定要删除么?" data-method="post">删除</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
                <?/*= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '<div class="table-responsive">{items}</div><div class="text-left tooltip-demo">{pager}</div>',
        'tableOptions'=>['class'=>'table table-striped'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pid',
            'name',
            'route',
            [
                'attribute' => 'is_show',
                'format' => 'html',
                'value' => function ($model) {
                    return \backend\models\Menu::$isShow[$model->is_show];
                },
            ],
            // 'data',
            // 'sort',
            // 'level',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'header' => '操作',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a("查看", $url, [
                            'title' => '查看',
                            'class' => 'btn btn-xs btn-outline btn-default',
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a("编辑", $url, [
                            'title' => '栏目信息',
                            'class' => 'btn btn-xs btn-outline btn-success',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', $url, [
                            'title' => '删除',
                            'class' => 'btn  btn-xs btn-outline btn-danger',
                            'data' => [
                            'confirm' => '确定要删除么?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]);  */?>
                    </div>
                    <div class="text-right tooltip-demo"></div>
                </div>
            </div>
        </div>
    </div>
</div>


