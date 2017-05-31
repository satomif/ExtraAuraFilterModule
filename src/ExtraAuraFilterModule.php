<?php
/**
 * This file is part of the Satomi.ExtraAuraFilterModule package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Satomif\ExtraAuraFilterModule;

use Aura\Filter\SubjectFilter;
use Ray\Di\AbstractModule;
use Ray\Validation\ValidateModule;
use Satomif\ExtraAuraFilterModule\Annotation\ValidationFilters;

class ExtraAuraFilterModule extends AbstractModule
{
    /**
     * @var array
     */
    private $validateConfig;

    public function __construct(array $validateConfig, AbstractModule $module = null)
    {
        $this->validateConfig = $validateConfig;
        parent::__construct($module);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->install(new ValidateModule());
        if ($this->validateConfig) {
            $this->bind()->annotatedWith(ValidationFilters::class)->toInstance($this->validateConfig);
            $this->bind(SubjectFilter::class)->toProvider(ExtraAuraFilterProvider::class);
        }
    }
}
