<?php
/**
 * This file is part of the Satomi.ExtraAuraFilterModule package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Satomif\ExtraAuraFilterModule;

use Aura\Filter\FilterFactory;
use Ray\Di\ProviderInterface;
use Satomif\ExtraAuraFilterModule\Annotation\ValidationFilters;

class AuraFilterProvider implements ProviderInterface
{
    private $validateFilters;

    /**
     * @ValidationFilters
     *
     * @param array $validateFilters
     */
    public function __construct(array $validateFilters = [])
    {
        $this->validateFilters = $validateFilters;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        return (new FilterFactory($this->validateFilters))->newSubjectFilter();
    }
}
