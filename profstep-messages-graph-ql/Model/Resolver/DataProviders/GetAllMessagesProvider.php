<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 16.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\MessagesGraphQl\Model\Resolver\DataProviders;


use ProfStep\Messages\Model\ResourceModel\Message\Collection as MessagesCollection;
use ProfStep\Messages\Model\ResourceModel\Message\CollectionFactory as MessagesCollectionFactory;
use ProfStep\MessagesGraphQl\Api\ProviderInterface;

/**
 * GetAllMessagesProvider class.
 * @package ProfStep\MessagesGraphQl\Model\Resolver\DataProviders
 */
class GetAllMessagesProvider implements ProviderInterface
{
    /**
     * Messages collection class.
     *
     * @var MessagesCollectionFactory
     */
    private MessagesCollectionFactory $messagesCollection;

    /**
     * GetAllMessagesProvider constructor.
     * @param MessagesCollectionFactory $messagesCollection
     */
    public function __construct(
        MessagesCollectionFactory $messagesCollection
    ) {
        $this->messagesCollection = $messagesCollection;
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
        /** @var MessagesCollection $collection */
        $collection = $this->messagesCollection->create();

        return $collection->getItems();
    }
}
