<?php
namespace Satomif\ExtraAuraFilterModule;

use Aura\Filter\SubjectFilter;
use Ray\Di\Di\Inject;

trait ValidationInject
{
    /**
     * @var
     */
    private $filter;

    /**
     * @param $filter
     * @Inject
     */
    public function setValidate(SubjectFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @param $validate
     *
     * @return string
     */
    public function getStringErrorMessage($validate)
    {
        $failures = $validate->getFailures();
        $msgs = $failures->getMessages();
        if (is_array($msgs)) {
            $text = [];
            foreach ($msgs as $val) {
                $text[] = $val[0];
            }
            $msgs = implode("\n", $text);
        }

        return $msgs;
    }
}
