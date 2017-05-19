<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
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

    <?= $form->field($model, 'pid')->dropDownList(\backend\models\Menu::getMenuDrop(), ['prompt'=>['text'=>'一级菜单','options'=>['value'=>0]]]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'route')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_show')->radioList(['1'=>'显示','0'=>'不显示']) ?>

    <?= $form->field($model, 'data')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

<div class="form-group">
    <div class="col-sm-4 col-sm-offset-3">
    <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

