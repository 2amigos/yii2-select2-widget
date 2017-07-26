<?php

/*
 * This file is part of the 2amigos/yii2-select2-widget project.
 * (c) 2amigOS! <http://2amigos.us/>
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace dosamigos\select2;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\widgets\InputWidget;

class Select2 extends InputWidget
{
    /**
     * @var array $items the option data items. The array keys are option values, and the array values
     *            are the corresponding option labels. The array can also be nested (i.e. some array values are arrays too).
     *            For each sub-array, an option group will be generated whose label is the key associated with the sub-array.
     *            If you have a list of data models, you may convert them into the format described above using
     *            [[\yii\helpers\ArrayHelper::map()]].
     *
     * @see [[\yii\helpers\Html::activeDropDownList()]]
     */
    public $items = [];
    /**
     * @var array the options for the underlying Select2 JS plugin.
     *            Please refer to the plugin Web page for possible options.
     *
     * @see https://select2.github.io/options.html#core-options
     */
    public $clientOptions = [];
    /**
     * @var array the event handlers for the underlying Select2 JS plugin.
     *            Please refer to the corresponding plugin Web page for possible events.
     *
     * @see https://select2.github.io/options.html#events
     */
    public $clientEvents = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->initPlaceholder();
    }

    /**
     * Select2 plugin placeholder check and initialization
     */
    protected function initPlaceholder()
    {
        $multipleSelection = ArrayHelper::getValue($this->options, 'multiple');

        if (!empty($this->options['prompt']) && empty($this->clientOptions['placeholder'])) {
            $this->clientOptions['placeholder'] = $multipleSelection
                ? ArrayHelper::remove($this->options, 'prompt')
                : $this->options['prompt'];

            return null;
        } elseif (!empty($this->options['placeholder'])) {
            $this->clientOptions['placeholder'] = ArrayHelper::remove($this->options, 'placeholder');
        }
        if (!empty($this->clientOptions['placeholder']) && !$multipleSelection) {
            $this->options['prompt'] = is_string($this->clientOptions['placeholder'])
                ? $this->clientOptions['placeholder']
                : ArrayHelper::getValue((array)$this->clientOptions['placeholder'], 'placeholder', '');
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeDropDownList($this->model, $this->attribute, $this->items, $this->options);
        } else {
            echo Html::dropDownList($this->name, $this->value, $this->items, $this->options);
        }
        $this->registerClientScript();
    }

    /**
     * @inheritdoc
     */
    public function registerClientScript()
    {
        $view = $this->getView();

        $this->registerBundle($view);

        $options = !empty($this->clientOptions)
            ? Json::encode($this->clientOptions)
            : '';

        $id = $this->options['id'];

        $js[] = ";jQuery('#$id').select2($options);";
        if (!empty($this->clientEvents)) {
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = "jQuery('#$id').on('$event', $handler);";
            }
        }

        $view->registerJs(implode("\n", $js));
    }

    /**
     * Registers asset bundle
     *
     * @param View $view
     */
    protected function registerBundle(View $view)
    {
        Select2Asset::register($view);
    }
}
