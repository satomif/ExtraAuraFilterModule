[![Build Status](https://travis-ci.org/satomif/ExtraAuraFilterModule.svg?branch=feature-2.x)](https://travis-ci.org/satomif/ExtraAuraFilterModule)

# ExtraAuraFilterModule
https://github.com/auraphp/Aura.Filter/blob/2.x/docs/custom.md

こちらのカスタムルールを追加するためのModuleです。


## module install
```
$config = require dirname(dirname(__DIR__)) . '/var/conf/validate.php';

$this->install(new AuraFilterModule($config));
```

## config(validate.php)
```
$config = [
    'mbstrlen-max' => \Satomif\ExtraAuraFilterModule\Filter\MbStrlenMax::class
];

return $config;
```

## how to validate
```
use ValidationInject;

$mbString = 'こんにちは！世界2！';
$this->filter->validate('var_name')->is('mbstrlen-max', 9);
$data = ['var_name' => $mbString];
$fail = $this->filter->apply($data);
if (! $fail) {
  $msgs = (string) $this->errorString;
}
```



