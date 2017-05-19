<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'static/css/bootstrap.min14ed.css?v=3.3.6',
        'static/css/font-awesome.min93e3.css?v=4.4.0',
        'static/css/animate.min.css',
        'static/css/style.min862f.css?v=4.1.0',
    ];
    public $js = [
        ['static/js/jquery.min.js?v=2.1.4', 'position' =>\yii\web\View::POS_HEAD],
        'static/js/bootstrap.min.js?v=3.3.6',
        'static/js/plugins/metisMenu/jquery.metisMenu.js',
        'static/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'static/js/plugins/layer/layer.min.js',
        'static/js/hplus.min.js?v=4.1.0',
        'static/js/contabs.min.js',
        'static/js/plugins/pace/pace.min.js',

    ];
    public $depends = [
    ];
}
