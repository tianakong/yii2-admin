<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(
    [
        'fieldConfig'=>[
            'template' => '<label class="col-sm-2 control-label">{label}</label><div class="col-sm-10">{input}<span id="cname-error" class="help-block m-b-none">{error}</span></div>',
        ],
        'options'=>['class' => 'form-horizontal']
    ]
); ?>

    <?= $form->field($model, 'webIds')->checkboxList(\backend\models\Web::getIds())->label('站点') ?>

    <?= $form->field($model, 'roleIds')->checkboxList(\backend\models\Role::getIds())->label('角色') ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => true])->label('密码') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?php $model->status=1;?>
    <?= $form->field($model, 'status')->radioList(\backend\models\User::$statusOption) ?>

<div class="form-group">
    <div class="col-sm-4 col-sm-offset-3">
    <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

