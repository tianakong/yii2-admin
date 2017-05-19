<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>


<?= "<?php " ?>$form = ActiveForm::begin(
    [
        'fieldConfig'=>[
            'template' => '<label class="col-sm-2 control-label">{label}</label><div class="col-sm-10">{input}<span id="cname-error" class="help-block m-b-none">{error}</span></div>',
        ],
        'options'=>['class' => 'form-horizontal']
    ]
); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
if (in_array($attribute, $safeAttributes)) {
    echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
}
} ?>
<div class="form-group">
    <div class="col-sm-4 col-sm-offset-3">
    <?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('添加') ?> : <?= $generator->generateString('修改') ?>, ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>
</div>

<?= "<?php " ?>ActiveForm::end(); ?>

