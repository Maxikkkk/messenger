<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Resource Model class Messenger
 * @package ProfStep\Messages\Model\ResourceModel
 */
class Message extends AbstractDb
{

    protected $_idFieldName = 'id';

    protected $_mainTable = 'profstep_messages';

    /**
     * Method initializes resource model.
     *
     * @return void
     * @throws LocalizedException
     */
    protected function _construct()
    {
        $this->_init(
            $this->getMainTable(),
            $this->getIdFieldName()
        );
    }
}
