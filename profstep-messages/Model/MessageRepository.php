<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Model;

use Exception;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use ProfStep\Messages\Api\Data\MessageInterface;
use ProfStep\Messages\Api\Data\MessageInterfaceFactory;
use ProfStep\Messages\Api\Data\MessageSearchResultsInterface;
use ProfStep\Messages\Api\Data\MessageSearchResultsInterfaceFactory;
use ProfStep\Messages\Api\MessageRepositoryInterface;
use ProfStep\Messages\Model\ResourceModel\Message as MessageResourceModel;
use ProfStep\Messages\Model\ResourceModel\Message\Collection;
use ProfStep\Messages\Model\ResourceModel\Message\CollectionFactory;

/**
 * Repository class MessagesRepository.
 * @package ProfStep\Messages\Model
 */
class MessageRepository implements MessageRepositoryInterface
{
    /**
     * Message ResourceModel.
     *
     * @var MessageResourceModel
     */
    private MessageResourceModel $messageResource;

    /**
     * Message model class.
     *
     * @var MessageInterfaceFactory
     */
    private MessageInterfaceFactory $message;

    /**
     * Message collection class.
     *
     * @var CollectionFactory
     */
    private CollectionFactory $collection;

    /**
     * Message search results class.
     *
     * @var MessageSearchResultsInterfaceFactory
     */
    private MessageSearchResultsInterfaceFactory $messageSearchResults;

    /**
     * Collection processor for filter.
     *
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * MessageRepository constructor.
     *
     * @param CollectionFactory $collection
     * @param MessageSearchResultsInterfaceFactory $messageSearchResults
     * @param CollectionProcessorInterface $collectionProcessor
     * @param MessageResourceModel $messageResource
     * @param MessageInterfaceFactory $message
     */
    public function __construct(
        CollectionFactory $collection,
        MessageSearchResultsInterfaceFactory $messageSearchResults,
        CollectionProcessorInterface $collectionProcessor,
        MessageResourceModel $messageResource,
        MessageInterfaceFactory $message
    ) {
        $this->messageResource = $messageResource;
        $this->message = $message;
        $this->collection = $collection;
        $this->messageSearchResults = $messageSearchResults;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Get message from the database by ID.
     *
     * @param int $id
     *
     * @return \ProfStep\Messages\Api\Data\MessageInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $id): MessageInterface
    {
        /** @var MessageInterface $message */
        $message = $this->message->create();

        $this->messageResource->load($message, $id);

        if(!$message->getId()) {
            throw new NoSuchEntityException(
                __("The request message doesn't exist.")
            );
        }

        return $message;
    }

    /**
     * Save message in the database.
     *
     * @param \ProfStep\Messages\Api\Data\MessageInterface $message
     *
     * @return \ProfStep\Messages\Api\Data\MessageInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(MessageInterface $message): MessageInterface
    {
        $this->messageResource->save($message);

        return $message;
    }

    /**
     * Delete message from the database.
     *
     * @param \ProfStep\Messages\Api\Data\MessageInterface $message
     *
     * @return bool Will returned True if deleted
     * @throws \Exception
     */
    public function delete(MessageInterface $message): bool
    {
        try {
            $this->messageResource->delete($message);
        } catch (Exception $e) {
            throw new Exception(
                __('This message couldn\'t be removed.')
            );
        }

        return true;
    }

    /**
     * Delete message from the database by ID.
     *
     * @param int $id
     *
     * @return bool Will returned True if deleted
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById(int $id): bool
    {
        $message = $this->getById($id);

        return $this->delete($message);
    }

    /**
     * Return list of filtered messages by search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \ProfStep\Messages\Api\Data\MessageSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): MessageSearchResultsInterface
    {
        /** @var Collection $collection */
        $collection = $this->collection->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var MessageSearchResultsInterface $results */
        $searchResults = $this->messageSearchResults->create();
        $searchResults->setSearchCriteria($searchCriteria)
            ->setItems($collection->getItems())
            ->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Return all messages.
     *
     * @return \ProfStep\Messages\Api\Data\MessageInterface[]
     */
    public function getAll()
    {
        /** @var Collection $collection */
        $collection = $this->collection->create();

        return $collection->getItems();
    }
}
