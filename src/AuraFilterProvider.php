<?php
namespace Satomif\ExtraAuraFilterModule;

use Aura\Filter\FilterFactory;
use Ray\Di\Di\Inject;
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
    public function __construct($validateFilter = [])
    {
        $this->validateFilter = $validateFilter;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $filterFactory = new FilterFactory($this->validateFilter);
        $filter = $filterFactory->newSubjectFilter();

        return $filter;
    }
}
