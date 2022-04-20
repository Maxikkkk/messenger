<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Controller\Adminhtml\Actions;

use DateTime;
use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use ProfStep\Messages\Api\Data\MessageInterface;
use ProfStep\Messages\Api\Data\MessageInterfaceFactory;
use ProfStep\Messages\Api\MessageRepositoryInterface;
use ProfStep\Messages\Model\MessageHelper;

/**
 * Edit action class.
 * @package ProfStep\Messages\Controller\Adminhtml\Actions
 */
class Actions implements HttpPostActionInterface
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
     * Create message model class.
     *
     * @var MessageHelper
     */
    private MessageHelper $messageHelper;

    /**
     * Message model class.
     *
     * @var MessageInterfaceFactory
     */
    private MessageInterfaceFactory $messageFactory;

    /**
     * Add constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param UrlInterface $urlBackend
     * @param ManagerInterface $messageManager
     * @param MessageRepositoryInterface $messageRepository
     * @param MessageHelper $messageHelper
     * @param MessageInterfaceFactory $messageFactory
     */
    public function __construct(
        ResultFactory $resultFactory,
        RequestInterface $request,
        UrlInterface $urlBackend,
        ManagerInterface $messageManager,
        MessageRepositoryInterface $messageRepository,
        MessageHelper $messageHelper,
        MessageInterfaceFactory $messageFactory
    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->urlBackend = $urlBackend;
        $this->messageManager = $messageManager;
        $this->messageRepository = $messageRepository;
        $this->messageHelper = $messageHelper;
        $this->messageFactory = $messageFactory;
    }

    /**
     * Controller's execute function which delete a message from db.
     *
     * @return Redirect
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(): Redirect
    {
        $data = $this->request->getParams();
        $id = (int)$data['id'];

        if ($id) {
            $this->messageHelper->saveMessageInstance($data);

            $this->messageManager->addSuccessMessage(
                __('You changed the message.')
            );
        } else {
            $this->messageHelper->saveMessageInstance($data);

            $this->messageManager->addSuccessMessage(
                __('You saved the message.')
            );
        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $url = $this->urlBackend->getUrl('messenger');
        $result->setPath($url);
        return $result;
    }
}
