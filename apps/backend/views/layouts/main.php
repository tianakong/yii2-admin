<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
$this->title = '微信营销系统';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link rel="shortcut icon" href="/favicon.ico">
    <?php $this->head() ?>
    <style>
        .top.fixed {
            position: fixed;
            left: 0;
            right: 0;
            z-index: 1000;
        }
    </style
    <?php if (isset($this->blocks['css'])): ?>
        <?= $this->blocks['css'] ?>
    <?php endif; ?>
</head>

<body class="fixed-sidebar full-height-layout gray-bg">
<?php $this->beginBody() ?>
<?php if((Yii::$app->controller->module->defaultRoute!="site") ||(Yii::$app->controller->module->defaultRoute=="site" && Yii::$app->controller->module->requestedRoute!=""
        && Yii::$app->controller->module->requestedRoute!="site/login")):?>
    <nav class="breadcrumb fix_top hidden-sm hidden-xs top fixed" style="height: 45px;">
        <?php $this->beginBlock('crumbs'); ?>
            <div class="pull-left col-lg-10" style="line-height:45px;">
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a>Graphs</a>
                    </li>
                    <li class="active">
                        <strong>Flot Charts</strong>
                    </li>
                </ol>
            </div>
        <?php $this->endBlock(); ?>
        <?php if (isset($this->blocks['option'])): ?>
            <?= $this->blocks['option'] ?>
        <?php else: ?>
            <div class="pull-right">
                <a class="btn btn-primary radius " style="line-height:1.6em;margin-top:3px" href="javascript:history.go(-1);" title="后退">
                    <span class="fa fa-reply"></span>
                </a>
                &nbsp;
                <a class="btn btn-primary radius" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
                    <span class="fa fa-refresh"></span>
                </a>
                &nbsp;
            </div>
        <?php endif; ?>
    </nav>
    <div style="padding-top: 45px;"></div>
<?php endif;?>
<?= $content ?>
<?php $this->endBody() ?>
<?php if (isset($this->blocks['js'])): ?>
    <?= $this->blocks['js'] ?>
<?php endif; ?>
<script src="/assets/3fed5bea/yii.js"></script>
</body>
</html>
<?php $this->endPage() ?>
