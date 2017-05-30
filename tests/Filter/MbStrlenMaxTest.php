<?php
namespace Satomif\ExtraAuraFilterModule;

use Aura\Filter\FilterFactory;
use Aura\Filter\SubjectFilter;
use Satomif\ExtraAuraFilterModule\Filter\MbStrlenMax;

class MbStrlenMaxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SubjectFilter
     */
    private $filter;

    /**
     * set up filter
     */
    protected function setUp()
    {
        $validate_factories = [
            MbStrlenMax::NAME => function () {
                return new MbStrlenMax;
            },
        ];
        $filter_factory = new FilterFactory($validate_factories);
        $this->filter = $filter_factory->newSubjectFilter();
    }

    /**
     * validate ok
     */
    public function testMbStrlenMaxOk()
    {
        $mbString = 'こんにちは！世界！';
        $this->filter->validate('var_name')->is(MbStrlenMax::NAME, 9);
        $data = ['var_name' => $mbString];
        $success = $this->filter->apply($data);
        $this->assertTrue($success);
        $errorMsg = new ErrorString($this->filter);
        $msgs = (string) $errorMsg;
        $this->assertSame('', $msgs);
    }

    /**
     * validate ng
     */
    public function testMbStrlenMaxNg()
    {
        $mbString = 'こんにちは！世界2！';
        $this->filter->validate('var_name')->is(MbStrlenMax::NAME, 9);
        $data = ['var_name' => $mbString];
        $fail = $this->filter->apply($data);
        $this->assertFalse($fail);
        $errorMsg = new ErrorString($this->filter);
        $msgs = (string) $errorMsg;
        $this->assertSame('var_name should have validated as mbStrlenMax(9)', $msgs);
    }
}
