<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(
    [
        'fieldConfig' => [
            'template' => '<label class="col-sm-2 control-label">{label}</label><div class="col-sm-10">{input}<span id="cname-error" class="help-block m-b-none">{error}</span></div>',
        ],
        'options' => ['class' => 'form-horizontal']
    ]
); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

<div class="form-group field-role-remarks">
    <label class="col-sm-2 control-label">
        <label class="control-label" for="role-remarks">权限</label>
    </label>
    <div class="col-sm-10">
        <ul id="treeDemo" class="ztree"></ul>
        <?= $form->field($model, 'priv')->hiddenInput(['id'=>'priv'])->label('') ?>
        <span id="cname-error" class="help-block m-b-none">
            <div class="help-block"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-4 col-sm-offset-3">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->beginBlock('css'); ?>
<link rel="stylesheet" href="/static/plugins/ztree/css/demo.css" type="text/css">
<link rel="stylesheet" href="/static/plugins/ztree/css/metroStyle/metroStyle.css" type="text/css">
<?php $this->endBlock(); ?>

<?php $this->beginBlock('js'); ?>
<script type="text/javascript" src="/static/plugins/ztree/js/jquery.ztree.core.js"></script>
<script type="text/javascript" src="/static/plugins/ztree/js/jquery.ztree.excheck.js"></script>
<script type="text/javascript" src="/static/plugins/ztree/js/jquery.ztree.exedit.js"></script>
<script type="text/javascript">
    var setting = {
        view: {
            selectedMulti: false,
        },
        check: {
            enable: true
        },
        data: {
            simpleData: {
                enable: true,
                idKey: "id",
                pIdKey: "pid",
            }
        },
        edit: {
            enable: false
        },
        callback: {
            onCheck: onCheck
        }
    };

    var zNodes = <?=$privData?>;

    $(document).ready(function () {
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    });

    function zTreeOnCheck(event, treeId, treeNode) {
        console.log(treeNode.id + ", " + treeNode.name + "," + treeNode.checked);
    }

    function onCheck(e, treeId, treeNode) {
        var treeObj = $.fn.zTree.getZTreeObj("treeDemo"),
            nodes = treeObj.getCheckedNodes(true),
            nodeIds = [];
        for (var i = 0; i < nodes.length; i++) {
            nodeIds.push(nodes[i].id);
        }
        $('#priv').val(nodeIds);
        //console.log(nodeIds);
    }

</script>
<?php $this->endBlock(); ?>
