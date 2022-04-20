<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Model\ResourceModel\Message;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use ProfStep\Messages\Model\Message;
use ProfStep\Messages\Model\ResourceModel\Message as MessageResourceModel;

/**
 * Collection class Messenger
 * @package ProfStep\Messages\Model\ResourceModel\Messenger
 */
class Collection extends AbstractCollection
{
    /**
     * Method initializes collection.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            Message::class,
            MessageResourceModel::class
        );
    }
}
