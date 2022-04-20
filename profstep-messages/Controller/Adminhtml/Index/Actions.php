<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;
use Magento\Store\Model\ScopeInterface;

/**
 * Adminhtml controller for message form page.
 * @package ProfStep\Messages\Controller\Adminhtml\Index
 */
class Actions implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'ProfStep_Messages::messenger';

    /**
     * Result factory class.
     *
     * @var ResultFactory
     */
    private ResultFactory $resultFactory;

    /**
     * Scope config class.
     *
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * Index constructor.
     * @param ResultFactory $resultFactory
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ResultFactory $resultFactory,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->resultFactory = $resultFactory;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Controller's execute method.
     *
     * @return Page
     */
    public function execute(): Page
    {
        if (!$this->scopeConfig->getValue('messenger/config/enabled', ScopeInterface::SCOPE_WEBSITE)) {
            $forwardFactory = $this->forwardFactory->create();
            $forwardFactory->setController('index')
                ->forward('defaultNoRoute');

            return $forwardFactory;
        }

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
