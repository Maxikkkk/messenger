<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Model;


use DateTime;
use Exception;
use Magento\Framework\Model\AbstractExtensibleModel;
use ProfStep\Messages\Api\Data\MessageInterface;
use ProfStep\Messages\Model\ResourceModel\Message as MessageResourceModel;

/**
 * Model class Messenger
 * @package ProfStep\Model
 */
class Message extends AbstractExtensibleModel implements MessageInterface
{
    /**
     * Method initializes model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            MessageResourceModel::class
        );
    }

    /**
     * Get fullname.
     *
     * @return string
     */
    public function getFullname(): string
    {
        return $this->getData('fullname');
    }

    /**
     * Set fullname.
     *
     * @param string $fullname
     * @return $this
     */
    public function setFullname(string $fullname): MessageInterface
    {
        $this->setData('fullname', $fullname);

        return $this;
    }

    /**
     * Get message email.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getData('email');
    }

    /**
     * Set message email.
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email): MessageInterface
    {
        $this->setData('email', $email);

        return $this;
    }

    /**
     * Get message text.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->getData('message');
    }

    /**
     * Set message text.
     *
     * @param string $message
     *
     * @return $this
     */
    public function setMessage(string $message): MessageInterface
    {
        $this->setData('message', $message);

        return $this;
    }

    /**
     * Return updated at time.
     *
     * @return string
     * @throws Exception
     */
    public function getUpdatedAt()
    {
        return $this->getData('updated_at');
    }

    /**
     * Set updated at time.
     *
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setUpdatedAt(DateTime $date): MessageInterface
    {
        $this->setData('updated_at', $date->format('Y-m-d H:i:s'));

        return $this;
    }

    /**
     * Return created at time.
     *
     * @return string
     * @throws Exception
     */
    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }

    /**
     * Set created at time.
     *
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setCreatedAt(DateTime $date): MessageInterface
    {
        $this->setData('created_at', $date->format('Y-m-d H:i:s'));

        return $this;
    }
}
