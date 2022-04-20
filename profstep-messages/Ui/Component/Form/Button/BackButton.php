<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Ui\Component\Form\Button;

use Magento\Cms\Block\Adminhtml\Block\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * BackButton Ui Element class.
 * @package ProfStep\Messages\Ui\Component\Form\Button
 */
class BackButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve button-specified settings.
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }

}
