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
    /**
     * @var SubjectFilter
     */
    private $subjectFilter;

    protected function setUp()
    {
        $config = ['mbstrlen-max' => MbStrlenMax::class];
        $this->subjectFilter = (new Injector(new ExtraAuraFilterModule($config)))->getInstance(SubjectFilter::class);
    }

    public function testModule()
    {
        $this->assertInstanceOf(SubjectFilter::class, $this->subjectFilter);
    }

    public function testSubjectFilterApplyReturnsBoolean()
    {
        $subject = ['foo' => 'bar'];
        $this->subjectFilter->validate('foo')->is('mbstrlen-max', 10);
        $this->assertInternalType('boolean', $this->subjectFilter->apply($subject));
    }
}
