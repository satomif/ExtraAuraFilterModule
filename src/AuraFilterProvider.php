<?php
/**
 * This file is part of the Satomi.ExtraAuraFilterModule package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Satomif\ExtraAuraFilterModule;

use Aura\Filter\FilterFactory;
use Ray\Di\ProviderInterface;
use Satomif\ExtraAuraFilterModule\Annotation\ValidationParameters;

class AuraFilterProvider implements ProviderInterface
{
    private $validateFilter;

    /**
     * @ValidationParameters
     *
     * @param array $validateFilter
     */
    public function __construct(array $validateFilter = [])
    {
        $this->validateFilter = $validateFilter;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $filterFactory = new FilterFactory($this->validateFilter);

        return $filterFactory->newSubjectFilter();
    }
}
