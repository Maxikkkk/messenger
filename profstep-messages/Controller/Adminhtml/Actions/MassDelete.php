<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Controller\Adminhtml\Actions;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Ui\Component\MassAction\Filter;
use ProfStep\Messages\Api\MessageRepositoryInterface;
use ProfStep\Messages\Model\ResourceModel\Message\CollectionFactory;

/**
 * MassDelete massaction class.
 * @package ProfStep\Messages\Controller\Adminhtml\Actions
 */
class MassDelete implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'ProfStep_Messages::messenger';

    /**
     * Filter component class.
     *
     * @var Filter
     */
    private Filter $filter;

    /**
     * Messages collection factory class.
     *
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * Message repository class.
     *
     * @var MessageRepositoryInterface
     */
    private MessageRepositoryInterface $messageRepository;

    /**
     * Message manager class.
     *
     * @var ManagerInterface
     */
    private ManagerInterface $messageManager;

    /**
     * Result page factory class.
     *
     * @var ResultFactory
     */
    private ResultFactory $resultFactory;

    /**
     * Url backend class.
     *
     * @var UrlInterface
     */
    private UrlInterface $urlBackend;

    /**
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param MessageRepositoryInterface $messageRepository
     * @param ManagerInterface $messageManager
     * @param ResultFactory $resultFactory
     * @param UrlInterface $urlBackend
     */
    public function __construct(
        Filter $filter,
        CollectionFactory $collectionFactory,
        MessageRepositoryInterface $messageRepository,
        ManagerInterface $messageManager,
        ResultFactory $resultFactory,
        UrlInterface $urlBackend
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->messageRepository = $messageRepository;
        $this->messageManager = $messageManager;
        $this->resultFactory = $resultFactory;
        $this->urlBackend = $urlBackend;
    }

    /**
     * Controller's execute function.
     *
     * @return Redirect
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(): Redirect
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionCount = $collection->getSize();

        foreach ($collection->getItems() as $item) {
            $this->messageRepository->delete($item);
        }

        $this->messageManager->addSuccessMessage(
            __('A total of %1 record(s) have been deleted.', $collectionCount)
        );

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $url = $this->urlBackend->getUrl('messenger');
        $result->setPath($url);
        return $result;
    }
}
