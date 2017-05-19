<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Web */
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

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(\backend\models\Web::$statusOption) ?>

<div class="form-group">
    <div class="col-sm-4 col-sm-offset-3">
    <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

