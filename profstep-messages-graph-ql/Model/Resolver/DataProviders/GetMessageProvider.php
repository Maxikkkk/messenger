<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 16.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\MessagesGraphQl\Model\Resolver\DataProviders;


use Magento\Framework\Exception\NoSuchEntityException;
use ProfStep\Messages\Api\MessageRepositoryInterface;
use ProfStep\MessagesGraphQl\Api\ProviderInterface;

/**
 * GetMessageProvider class.
 * @package ProfStep\MessagesGraphQl\Model\Resolver\DataProviders
 */
class GetMessageProvider implements ProviderInterface
{
    /**
     * Message repository class.
     *
     * @var MessageRepositoryInterface
     */
    private MessageRepositoryInterface $messageRepository;

    /**
     * GetMessageProvider constructor.
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(
        MessageRepositoryInterface $messageRepository
    ) {
        $this->messageRepository = $messageRepository;
    }

    /**
     * Method process a request and return result
     *
     * @param array $data
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function process(array $data)
    {
        try {
            $result = $this->messageRepository->getById($data['id']);
        } catch (\Exception $e) {
            throw new NoSuchEntityException(
                __('No message with ID %1', $data['id'])
            );
        }

        return $result->toArray();
    }
}
