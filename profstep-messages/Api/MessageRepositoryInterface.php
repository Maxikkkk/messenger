<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use ProfStep\Messages\Api\Data\MessageInterface;
use ProfStep\Messages\Api\Data\MessageSearchResultsInterface;

/**
 * @api
 */
interface MessageRepositoryInterface
{

    /**
     * Get message from the database by ID.
     *
     * @param int $id
     *
     * @return \ProfStep\Messages\Api\Data\MessageInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): MessageInterface;

    /**
     * Save message in the database.
     *
     * @param \ProfStep\Messages\Api\Data\MessageInterface $message
     *
     * @return \ProfStep\Messages\Api\Data\MessageInterface
     */
    public function save(MessageInterface $message): MessageInterface;

    /**
     * Delete message from the database.
     *
     * @param \ProfStep\Messages\Api\Data\MessageInterface $message
     *
     * @return bool Will returned True if deleted
     */
    public function delete(MessageInterface $message): bool;

    /**
     * Delete message from the database by ID.
     *
     * @param int $id
     *
     * @return bool Will returned True if deleted
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool;

    /**
     * Return list of filtered messages by search criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return \ProfStep\Messages\Api\Data\MessageSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): MessageSearchResultsInterface;

    /**
     * Return all messages.
     *
     * @return \ProfStep\Messages\Api\Data\MessageInterface[]
     */
    public function getAll();
}
