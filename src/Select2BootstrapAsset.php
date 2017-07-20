<?php

namespace dosamigos\select2;

use yii\web\AssetBundle;

class Select2BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/select2-bootstrap-theme/dist';

    public $css = [
        'select2-bootstrap.css'
    ];

    public $depends = [
        'dosamigos\select2\Select2Asset',
        'yii\bootstrap\BootstrapAsset'
    ];
}
