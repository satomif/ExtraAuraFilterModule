<?php
/**
 * This file is part of the Satomi.ExtraAuraFilterModule package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Satomif\ExtraAuraFilterModule;

use Aura\Filter\FilterFactory;
use Ray\Di\Exception\Unbound;
use Ray\Di\ProviderInterface;
use Satomif\ExtraAuraFilterModule\Annotation\ValidationFilters;

class ExtraAuraFilterProvider implements ProviderInterface
{
    private $validateFilters;

    /**
     * @ValidationFilters
     *
     * @param array $validateFilters
     */
    public function __construct(array $validateFilters = [])
    {
        $factories = [];
        foreach ($validateFilters as $key => $value) {
            if (! class_exists($value)) {
                throw new Unbound($value);
            }
            $factories[$key] = function () use ($value) {
                return new $value;
            };
        }
        $this->validateFilters = $factories;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        return (new FilterFactory($this->validateFilters))->newSubjectFilter();
    }
}
