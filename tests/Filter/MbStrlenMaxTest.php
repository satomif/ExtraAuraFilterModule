<?php
namespace Satomif\ExtraAuraFilterModule;

use Aura\Filter\FilterFactory;
use Satomif\ExtraAuraFilterModule\Filter\MbStrlenMax;

class MbStrlenMaxTest extends \PHPUnit_Framework_TestCase
{
    use ValidationInject;
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
        $this->filter->validate('check_string')->is(MbStrlenMax::NAME, 9);
        $data = ['check_string' => $mbString];
        $success = $this->filter->apply($data);
        $this->assertTrue($success);
    }

    /**
     * validate ng
     */
    public function testMbStrlenMaxNg()
    {
        $mbString = 'こんにちは！世界2！';
        $this->filter->validate('check_string')->is(MbStrlenMax::NAME, 9);
        $data = ['check_string' => $mbString];
        $fail = $this->filter->apply($data);
        $this->assertFalse($fail);
        $msgs = $this->getStringErrorMessage($this->filter);
        $this->assertSame('check_string should have validated as mbStrlenMax(9)', $msgs);
    }
}
