<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Controller\Index;


use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\HTTP\Adapter\Curl;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\Page;
use Magento\Store\Model\ScopeInterface;

/**
 * Controller which trigger on messenger route.
 *
 * @package ProfStep\Messages\Controller\Index
 */
class Index implements HttpGetActionInterface
{
    /**
     * Factory which return controller type.
     *
     * @var ResultFactory
     */
    private ResultFactory $resultFactory;

    /**
     * Interface which return value from store configuration.
     *
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * Interface which help with url actions.
     *
     * @var UrlInterface
     */
    private UrlInterface $url;

    /**
     * Controller constructor.
     * @param ResultFactory $resultFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param UrlInterface $url
     */
    public function __construct(
        ResultFactory $resultFactory,
        ScopeConfigInterface $scopeConfig,
        UrlInterface $url
    ) {
        $this->resultFactory = $resultFactory;
        $this->scopeConfig = $scopeConfig;
        $this->url = $url;
    }

    /**
     * Execute controller's method.
     */
    public function execute()
    {
        if (!$this->scopeConfig->getValue('messenger/config/enabled', ScopeInterface::SCOPE_WEBSITE)) {
            $redirectFactory = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);

            $redirectFactory->setController('defaultNoRoute');
            $redirectFactory->forward('index');
            return $redirectFactory;
        }

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
