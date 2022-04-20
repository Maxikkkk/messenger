<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Model;

use Magento\Framework\Api\Search\SearchResult;
use ProfStep\Messages\Api\Data\MessageSearchResultsInterface;

/**
 * MessageSearchResults class.
 * @package ProfStep\Messages\Model
 */
class MessageSearchResults extends SearchResult implements MessageSearchResultsInterface
{

}
