<?php
namespace Satomif\ExtraAuraFilterModule;

use Aura\Filter\SubjectFilter;

final class ErrorString
{
    /**
     * @var SubjectFilter
     */
    private $filter;

    public function __construct(SubjectFilter $filter)
    {
        $this->filter = $filter;
    }

    public function __toString()
    {
        $failures = $this->filter->getFailures();
        $msgs = $failures->getMessages();
        $text = [];
        foreach ($msgs as $val) {
            $text[] = $val[0];
        }
        $msgs = implode("\n", $text);

        return (string) $msgs;
    }
}
