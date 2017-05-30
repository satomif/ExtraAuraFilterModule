<?php
/**
 * This file is part of the Satomi.ExtraAuraFilterModule package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Satomif\ExtraAuraFilterModule;

use Aura\Filter\SubjectFilter;
use Ray\Di\Di\Inject;

trait ValidationInject
{
    /**
     * @var SubjectFilter
     */
    private $filter;

    /**
     * @var
     */
    private $errorMesssages;

    /**
     * @param $filter
     * @Inject
     */
    public function setValidate(SubjectFilter $filter)
    {
        $this->filter = $filter;
        $this->errorMesssages = new ErrorString($filter);
    }
}
