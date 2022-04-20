<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Controller\Index;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\ScopeInterface;
use ProfStep\Messages\Model\MessageHelper;

/**
 * Controller for create a message.
 *
 * @package ProfStep\Messages\Controller\Index
 */
class Add implements HttpPostActionInterface
{
    /**
     * Model class which create a message
     *
     * @var MessageHelper
     */
    private MessageHelper $messageHelper;

    /**
     * Result factory class.
     *
     * @var ResultFactory
     */
    private ResultFactory $resultFactory;

    /**
     * Url model class.
     *
     * @var UrlInterface
     */
    private UrlInterface $url;

    /**
     * Request model class.
     *
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * Message manager interface.
     *
     * @var ManagerInterface
     */
    private ManagerInterface $messageManager;

    /**
     * Scope config class.
     *
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * Actions constructor.
     *
     * @param MessageHelper $messageHelper
     * @param ResultFactory $resultFactory
     * @param UrlInterface $url
     * @param RequestInterface $request
     * @param ManagerInterface $messageManager
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        MessageHelper $messageHelper,
        ResultFactory $resultFactory,
        UrlInterface $url,
        RequestInterface $request,
        ManagerInterface $messageManager,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->messageHelper = $messageHelper;
        $this->resultFactory = $resultFactory;
        $this->url = $url;
        $this->request = $request;
        $this->messageManager = $messageManager;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Execute controller's method.
     */
    public function execute()
    {
        $data = $this->request->getParams();

        $message = $this->messageHelper->saveMessageInstance($data);

        $this->messageManager->addSuccessMessage(
            __('Message on email %1 has been send!', $message->getEmail())
        );

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $path = $this->url->getUrl('');
        $result->setPath($path);

        return $result;
    }
}
