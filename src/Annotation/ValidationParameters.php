<?php
namespace Satomif\ExtraAuraFilterModule\Annotation;

use Ray\Di\Di\Qualifier;

/**
 * @Annotation
 * @Target("METHOD")
 * @Qualifier
 */
final class ValidationParameters
{
    /**
     * @var array
     */
    public $value;
}
