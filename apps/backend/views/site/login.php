<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>狗杂种微信系统 - 登录</title>
    <link href="/css/site.css" rel="stylesheet">
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/static/css/animate.min.css" rel="stylesheet">
    <link href="/static/css/style.min.css" rel="stylesheet">
    <link href="/static/css/login.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->
    <script>
        if (window.top !== window.self) {
            window.top.location = window.location
        }
        ;
    </script>
    <script src="/static/js/jquery.min.js?v=2.1.4"></script>
</head>
<body class="signin">
<div class="signinpanel">
    <div class="row">
        <div class="col-sm-7">
            <div class="signin-info">
                <div class="logopanel m-b">
                    <h1>[ H+ ]</h1>
                </div>
                <div class="m-b"></div>
                <h4>欢迎使用 <strong>H+ 后台主题UI框架</strong></h4>
                <ul class="m-b">
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势一</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势二</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势三</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势四</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势五</li>
                </ul>
                <strong>还没有账号？ <a href="#">立即注册&raquo;</a></strong>
            </div>
        </div>
        <div class="col-sm-5">
            <?php $form = ActiveForm::begin(
                [
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'template' => '{input}{error}',
                    ],
                ]);
            ?>
            <h4 class="no-margins">登录：</h4>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control uname']) ?>
            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control pword m-b']) ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <?= Html::submitButton('登录', ['class' => 'btn btn-success btn-block', 'name' => 'login-button']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="signup-footer">
        <div class="pull-left">
            &copy; 2017 All Rights Reserved. H+
        </div>
    </div>
</div>
<script src="/assets/1cd7d91a/yii.js"></script>
<script src="/assets/1cd7d91a/yii.validation.js"></script>
<script src="/assets/1cd7d91a/yii.activeForm.js"></script>
<script type="text/javascript">jQuery(document).ready(function () {
        jQuery('#login-form').yiiActiveForm([{
            "id": "loginform-username",
            "name": "username",
            "container": ".field-loginform-username",
            "input": "#loginform-username",
            "error": ".help-block.help-block-error",
            "validate": function (attribute, value, messages, deferred, $form) {
                yii.validation.required(value, messages, {"message": "请填写用户名"});
            }
        }, {
            "id": "loginform-password",
            "name": "password",
            "container": ".field-loginform-password",
            "input": "#loginform-password",
            "error": ".help-block.help-block-error",
            "validate": function (attribute, value, messages, deferred, $form) {
                yii.validation.required(value, messages, {"message": "请填写密码"});
            }
        }, {
            "id": "loginform-rememberme",
            "name": "rememberMe",
            "container": ".field-loginform-rememberme",
            "input": "#loginform-rememberme",
            "error": ".help-block.help-block-error",
            "validate": function (attribute, value, messages, deferred, $form) {
                yii.validation.boolean(value, messages, {
                    "trueValue": "1",
                    "falseValue": "0",
                    "message": "Remember Me must be either \"1\" or \"0\".",
                    "skipOnEmpty": 1
                });
            }
        }], []);
    });</script>
</body>
</html>

