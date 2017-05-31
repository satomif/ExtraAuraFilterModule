<?php
/**
 * This file is part of the Satomi.ExtraAuraFilterModule package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Satomif\ExtraAuraFilterModule;

use Aura\Filter\SubjectFilter;
use PHPUnit\Framework\TestCase;
use Ray\Di\Injector;
use Satomif\ExtraAuraFilterModule\Filter\MbStrlenMax;

class AuraFilterModuleTest extends TestCase
{
    public function testModule()
    {
        $config = ['mbstrlen-max' => MbStrlenMax::class];
        $subjectFilter = (new Injector(new ExtraAuraFilterModule($config)))->getInstance(SubjectFilter::class);
        $this->assertInstanceOf(SubjectFilter::class, $subjectFilter);
    }
}
