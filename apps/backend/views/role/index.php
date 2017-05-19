<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php  $this->beginBlock('option'); ?>
<div class="pull-right" style="line-height: 42px;margin-right: 5px;">
    <?= Html::a('添加', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    <a class="btn btn-primary btn-sm" href="javascript:location.replace(location.href);" title="刷新">
        <span class="fa fa-refresh"></span>
    </a>
</div>
<?php  $this->endBlock(); ?>
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>角色管理</h5>&nbsp;&nbsp;<font>(共<?= $dataProvider->getTotalCount()?>条记录)</font>
                <div class="ibox-tools">
                    <a style="color:#999;" class="" href="javascript:location.replace(location.href);" title="刷新">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '<div class="table-responsive">{items}</div><div class="text-right tooltip-demo">{pager}</div>',
        'tableOptions'=>['class'=>'table table-striped'],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'remarks',
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
    ]); ?>
            </div>
        </div>
    </div>
</div>
