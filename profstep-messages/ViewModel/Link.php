<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * ViewModel Link.
 * @package ProfStep\Messages\ViewModel
 */
class Link implements ArgumentInterface
{
    private ScopeConfigInterface $scopeConfig;

    /**
     * Link constructor.
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Checks if extension is enabled.
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return (bool)$this->scopeConfig->getValue('messenger/config/enabled', ScopeInterface::SCOPE_WEBSITE);
    }
}
