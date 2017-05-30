<?php
namespace Satomif\ExtraAuraFilterModule;

use Aura\Filter\SubjectFilter;
use Ray\Di\AbstractModule;
use Ray\Di\Exception\Unbound;
use Ray\Validation\ValidateModule;
use Satomif\ExtraAuraFilterModule\Annotation\ValidationParameters;

class AuraFilterModule extends AbstractModule
{
    private $validateConfig;

    /**
     * AuraFilterModule constructor.
     *
     * @param AbstractModule $validateConfig
     */
    public function __construct(array $validateConfig, AbstractModule $module = null)
    {
        if (! empty($validateConfig)) {
            foreach ($validateConfig as $key => $value) {
                if (! class_exists($value)) {
                    throw new Unbound($value . ' is not found.');
                }
                $validateConfig[$key] = function () use ($value) {
                    new $value;
                };
            }
            $this->validateConfig = $validateConfig;
        }
        parent::__construct($module);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->install(new ValidateModule());
        if (! empty($this->validate_config)) {
            $this->bind(ValidationParameters::class)->toInstance($this->validate_config);
            $this->bind(SubjectFilter::class)->toProvider(AuraFilterProvider::class);
        }
    }
}
