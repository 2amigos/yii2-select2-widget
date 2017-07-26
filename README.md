# Select2 Widget for Yii2

[![Latest Version](https://img.shields.io/github/release/2amigos/yii2-select2-widget.svg?style=flat-square)](https://github.com/2amigos/yii2-select2-widget/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/2amigos/yii2-select2-widget/master.svg?style=flat-square)](https://travis-ci.org/2amigos/yii2-select2-widget)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/2amigos/yii2-select2-widget.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-select2-widget/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/2amigos/yii2-select2-widget.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-select2-widget)
[![Total Downloads](https://poser.pugx.org/2amigos/yii2-select2-widget/downloads)](https://packagist.org/packages/2amigos/yii2-select2-widget)

[Select2](https://select2.github.io/) gives you a customizable select box with support for searching, tagging, remote 
data sets, infinite scrolling, and many other highly used options.

## Install

Via Composer

```bash
$ composer require 2amigos/yii2-select2-widget
```

## Usage

The Widget comes in two flavors, one for the classic and the bootstrap. The widgets, apart from the bootstrap one that 
requires some tweaks, are mostly configured throughout the `clientOptions` and `clientEvents`. Attributes that hold the 
configuration of the plugin and its events respectively. 

For that reason, we highly recommend you to visit the 
[Select2 Documentation](https://select2.github.io/options.html) for the possible options available on Select2 and 
[Select2 Bootstrap Theme](https://select2.github.io/select2-bootstrap-theme/4.0.3.html) to check all the possible 
display options regarding Select2 with this theme. 

> **Note** We are in the process to create a website that will demo all our widgets, including this. The following are 
> some basic samples to get you started. On the website, demos will be extensive and showing all possible configuration 
> options.


### Using Select2Widget

```php 
use dosamigos\select2\Select2:


// with \yii\bootstrap\ActiveForm;
echo $form
    ->field($model, 'attribute')
    ->widget(
        Select2::class, 
        [
            'items' => $data, // $data should be the same as the items provided to a regular yii2 dropdownlist
            'clientOptions' => ['theme' => 'classic']
        ]
    );
    
// as widget 
echo Select2::widget([
    'name' => 'my-name',
    'value' => 'my-value',
    'clientOptions' => [
        'maximumInputLength' => 20
    ]
]); 
```

### Using Select2BootstrapWidget 

```php 
use dosamigos\select2\Select2Bootstrap:

// displaying the select2 with prepended addon
echo $form
    ->field($model, 'attribute')
    ->widget(
        Select2Bootstrap::class, 
        [
            'items' => $data, // $data should be the same as the items provided to a regular yii2 dropdownlist
            'template' => '<div class="input-group">' .
                  '<span class="input-group-btn">' .
                  '<button class="btn btn-default" type="button" data-select2-open="multi-prepend-append">' .
                  'State' .
                  '</button>' .
                  '</span>' .
                  '{input}' .
                   '<span class="input-group-addon">Append</span>' .
                   '</div>'
        ]
    );
    
// as widget 
echo Select2Bootstrap::widget([
    'name' => 'my-name',
    'value' => 'my-value',
    'clientOptions' => [
        'maximumInputLength' => 20
    ]
]); 
```

## Testing

```bash
$ phpunit
```

## Using code fixer

We have added a PHP code fixer to standardize our code. It includes Symfony, PSR2 and some contributors rules. 

```bash 
./vendor/bin/php-cs-fixer fix ./src --config .php_cs
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [2amigos](https://github.com/2amigos)
- [All Contributors](../../contributors)

## License

The BSD License (BSD). Please see [License File](LICENSE.md) for more information.

<blockquote>
    <a href="http://www.2amigos.us"><img src="http://www.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0.png"></a><br>
    <i>Custom Software | Web & Mobile Development</i><br>
    <a href="http://www.2amigos.us">www.2amigos.us</a>
</blockquote>
