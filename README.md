[![Build Status](https://travis-ci.org/satomif/ExtraAuraFilterModule.svg?branch=feature-2.x)](https://travis-ci.org/satomif/ExtraAuraFilterModule)

# ExtraAuraFilterModule
https://github.com/auraphp/Aura.Filter/blob/2.x/docs/custom.md

こちらのカスタムルールを追加するためのModuleです。


## module install
$config = require dirname(dirname(__DIR__)) . '/var/conf/validate.php';

$this->install(new AuraFilterModule($config));

## config(validate.php)
$config = [
    \Satomif\ExtraAuraFilterModule\Filter\MbStrlenMax::NAME => \Satomif\ExtraAuraFilterModule\Filter\MbStrlenMax::class
];

return $config;

## how to validate
```
use ValidationInject;

$mbString = 'こんにちは！世界！';
$this->filter->validate('check_string')->is(MbStrlenMax::NAME, 8);
$data = ['check_string' => $mbString];
$fail = $this->filter->apply($data);
// error messages
$msgs = $this->getStringErrorMessage($this->filter);
```



