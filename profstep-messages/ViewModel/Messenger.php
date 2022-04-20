<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\ViewModel;

use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * ViewModel Messenger.
 * @package ProfStep\Messages\ViewModel
 */
class Messenger implements ArgumentInterface
{
    const ALL_INPUT_ATTR = [
        'required' => '',
        'minlength' => 4,
        'maxlength' => 54
    ];

    const INPUT_TYPES = [
        'email' => [
            'email' => ''
        ]
    ];

    /**
     * Return attributes for input validation.
     *
     * @param null $type
     * @return string
     */
    public function getInputAttr($type = null): string
    {
        $attrs = self::ALL_INPUT_ATTR;

        if ($type) {
            $attrs = array_merge($attrs, self::INPUT_TYPES[$type]);
        }

        $validateStr = '';

        foreach($attrs as $attr => $value) {
            $validateStr .= ($value) ? "$attr=\"$value\" " : "$attr ";
        }

        return $validateStr;
    }
}
