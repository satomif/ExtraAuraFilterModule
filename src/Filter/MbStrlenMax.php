<?php
/**
 * This file is part of the Satomi.ExtraAuraFilterModule package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Satomif\ExtraAuraFilterModule\Filter;

class MbStrlenMax
{
    const NAME = 'mbStrlenMax';

    /**
     * multi byte string length
     */
    public function __invoke($subject, $field, $max = null)
    {
        $value = $subject->$field;
        if (mb_strlen($value, 'utf-8') <= $max) {
            return true;
        }

        return false;
    }
}
