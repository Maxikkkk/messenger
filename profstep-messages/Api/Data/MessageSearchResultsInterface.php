<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Api\Data;


use Magento\Framework\Api\SearchResultsInterface;

/**
 * @api
 */
interface MessageSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \ProfStep\Messages\Api\Data\MessageInterface[]
     */
    public function getItems();

    /**
     * @param \ProfStep\Messages\Api\Data\MessageInterface[] $items
     *
     * @return \ProfStep\Messages\Api\Data\MessageSearchResultsInterface
     */
    public function setItems(array $items);
}
