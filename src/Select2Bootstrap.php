<?php

/*
 * This file is part of the 2amigos/yii2-select2-widget project.
 * (c) 2amigOS! <http://2amigos.us/>
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace dosamigos\select2;

use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;

class Select2Bootstrap extends Select2
{
    /**
     * @var string the template to render the dropdown box that will be converted by select2 plugin. It is highly
     *             recommended that you use \yii\bootstrap\ActiveForm when using
     *             `$this->form($model, 'attribute')->widget(Select2Widget::class, [])` as it will handle the rest of the wrapping
     *             required for a proper Bootstrap input. If you wish to display Select2 with prepended and appended addons:
     *
     * ```
     * 'template' => '<div class="input-group">' .
     *              '<span class="input-group-btn">' .
     *              '<button class="btn btn-default" type="button" data-select2-open="multi-prepend-append">' .
     *              'State' .
     *              '</button>' .
     *              '</span>' .
     *              '{input}' .
     *              '<span class="input-group-addon">Append</span>' .
     *              '</div>'
     * ```
     *
     * That way you don't need to deal with the template from the \yii\bootstrap\ActiveField class.
     */
    public $template = '{input}';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->clientOptions['theme'] = 'bootstrap';

        if (!empty($this->options['multiple'])) {
            Html::addCssClass($this->options, 'select2-multiple');
        }

        if (ArrayHelper::getValue($this->clientOptions, 'allowClear')) {
            Html::addCssClass($this->options, 'select2-allow-clear');
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            $input = Html::activeDropDownList($this->model, $this->attribute, $this->items, $this->options);
        } else {
            $input = Html::dropDownList($this->name, $this->value, $this->items, $this->options);
        }

        echo strtr($this->template, ['{input}' => $input]);

        $this->registerClientScript();
    }

    /**
     * @inheritdoc
     */
    protected function registerBundle(View $view)
    {
        Select2BootstrapAsset::register($view);
    }
}
