<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Controller\Adminhtml\Actions;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use ProfStep\Messages\Api\MessageRepositoryInterface;

/**
 * Delete action class.
 * @package ProfStep\Messages\Controller\Adminhtml\Actions
 */
class Delete implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'ProfStep_Messages::messenger';

    /**
     * Page result factory class.
     *
     * @var ResultFactory
     */
    private ResultFactory $resultFactory;

    /**
     * HTTP request class.
     *
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * Url backend model class.
     *
     * @var UrlInterface
     */
    private UrlInterface $urlBackend;

    /**
     * Message manager class.
     *
     * @var ManagerInterface
     */
    private ManagerInterface $messageManager;

    /**
     * Message repository.
     *
     * @var MessageRepositoryInterface
     */
    private MessageRepositoryInterface $messageRepository;

    /**
     * Add constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param UrlInterface $urlBackend
     * @param ManagerInterface $messageManager
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(
        ResultFactory $resultFactory,
        RequestInterface $request,
        UrlInterface $urlBackend,
        ManagerInterface $messageManager,
        MessageRepositoryInterface $messageRepository
    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->urlBackend = $urlBackend;
        $this->messageManager = $messageManager;
        $this->messageRepository = $messageRepository;
    }

    /**
     * Controller's execute function which delete a message from db.
     *
     * @return Redirect
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $data = $this->request->getParams();
        $id = $data['id'];

        if ($id) {
            $this->messageRepository->deleteById((int)$id);
            $this->messageManager->addSuccessMessage(
                __('Message with ID: %1 has been deleted', $id)
            );
        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $url = $this->urlBackend->getUrl('messenger');
        $result->setPath($url);
        return $result;
    }
}
