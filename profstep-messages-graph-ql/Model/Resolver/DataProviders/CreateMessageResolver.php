<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 17.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\MessagesGraphQl\Model\Resolver\DataProviders;


use ProfStep\Messages\Api\Data\MessageInterface;
use ProfStep\Messages\Api\Data\MessageInterfaceFactory;
use ProfStep\Messages\Api\MessageRepositoryInterface;
use ProfStep\MessagesGraphQl\Api\ProviderInterface;

/**
 * CreateMessageResolver DataProvider class.
 * @package ProfStep\MessagesGraphQl\Model\Resolver\DataProviders
 */
class CreateMessageResolver implements ProviderInterface
{

    /**
     * Message repository class.
     *
     * @var MessageRepositoryInterface
     */
    private MessageRepositoryInterface $messageRepository;

    /**
     * Message model class.
     *
     * @var MessageInterfaceFactory
     */
    private MessageInterfaceFactory $message;

    /**
     * GetMessageProvider constructor.
     * @param MessageRepositoryInterface $messageRepository
     * @param MessageInterfaceFactory $message
     */
    public function __construct(
        MessageRepositoryInterface $messageRepository,
        MessageInterfaceFactory $message
    ) {
        $this->messageRepository = $messageRepository;
        $this->message = $message;
    }

    /**
     * Method process a request and return result
     *
     * @param array $data
     *
     * @return array
     */
    public function process(array $data)
    {
        $data = $data['data'];

        /** @var MessageInterface $message */
        $message = $this->message->create();

        $message->setFullname($data['fullname'])
            ->setEmail($data['email'])
            ->setMessage($data['message']);

        $this->messageRepository->save($message);

        return $message->toArray();
    }
}
