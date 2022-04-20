<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Controller\Adminhtml\Index;

use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Adminhtml controller's class.
 * @package ProfStep\Messages\Controller\Adminhtml\Index
 */
class Index implements HttpGetActionInterface
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
     * Forward factory class.
     *
     * @var ForwardFactory
     */
    private ForwardFactory $forwardFactory;

    /**
     * Index constructor.
     * @param ResultFactory $resultFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param ForwardFactory $forwardFactory
     */
    public function __construct(
        ResultFactory $resultFactory,
        ScopeConfigInterface $scopeConfig,
        ForwardFactory $forwardFactory
    ) {
        $this->resultFactory = $resultFactory;
        $this->scopeConfig = $scopeConfig;
        $this->forwardFactory = $forwardFactory;
    }

    /**
     * Controller's execute method.
     *
     * @return ResultInterface
     */
    public function execute()
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
