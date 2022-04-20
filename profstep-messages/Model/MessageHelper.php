<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Model;

use Exception;
use Magento\Customer\Model\Session;
use Magento\Framework\Escaper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use ProfStep\Messages\Api\Data\MessageInterface;
use ProfStep\Messages\Api\Data\MessageInterfaceFactory;
use ProfStep\Messages\Api\MessageRepositoryInterface;

/**
 * MessageHelper model class.
 * @package ProfStep\Messages\Model
 */
class MessageHelper
{
    /**
     * Required fields for validate
     */
    private const REQUIRE_FIELDS = ['fullname', 'email', 'message'];

    /**
     * Message model class.
     *
     * @var MessageInterfaceFactory
     */
    private MessageInterfaceFactory $messageFactory;

    /**
     * Message repository class.
     *
     * @var MessageRepositoryInterface
     */
    private MessageRepositoryInterface $messageRepository;

    /**
     * Customer session class.
     *
     * @var Session
     */
    private Session $customerSession;

    /**
     * Escaper class.
     *
     * @var Escaper
     */
    private Escaper $escaper;

    /**
     * MessageHelper constructor.
     * @param MessageInterfaceFactory $messageFactory
     * @param MessageRepositoryInterface $messageRepository
     * @param Session $customerSession
     * @param Escaper $escaper
     */
    public function __construct(
        MessageInterfaceFactory $messageFactory,
        MessageRepositoryInterface $messageRepository,
        Session $customerSession,
        Escaper $escaper
    ) {
        $this->messageFactory = $messageFactory;
        $this->messageRepository = $messageRepository;
        $this->customerSession = $customerSession;
        $this->escaper = $escaper;
    }

    /**
     * Validate recieved data.
     *
     * @param array $data
     * @return bool
     */
    public function validateData(array $data): bool
    {
        foreach(self::REQUIRE_FIELDS as $field) {
            if (!$data[$field]) {
                return false;
            }
        }

        return true;
    }

    /**
     * Method create message and save it in the database.
     *
     * @param array $data
     *
     * @return MessageInterface
     * @throws LocalizedException
     * @throws Exception
     */
    public function saveMessageInstance(array $data): MessageInterface
    {
        if(!$this->validateData($data)) {
            throw new NoSuchEntityException(
                __('Required fields must be filled')
            );
        }

        /** Escape HTML for all items in array */
        $data = array_map(function ($item) {
            return $this->escaper->escapeHtml($item);
        }, $data);

        /** @var MessageInterface $message */
        $message = $this->messageFactory->create();
        $message->setMessage($data['message'])
            ->setEmail($data['email'])
            ->setFullname($data['fullname'])
            ->setUpdatedAt(
                new \DateTime()
            )
            ->setId($data['id'] ?? null);

        if($this->customerSession->isLoggedIn()) {
            $customer = $this->customerSession->getCustomer();
            $message->setFullname($customer->getName())
                ->setEmail($customer->getEmail());
        }

        try {
            return $this->messageRepository->save($message);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
