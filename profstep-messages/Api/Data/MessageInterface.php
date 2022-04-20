<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * @api
 */
interface MessageInterface extends CustomAttributesDataInterface
{
    /**
     * Return message id;
     *
     * @return int
     */
    public function getId();

    /**
     * Set message id;
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id);

    /**
     * Get fullname.
     *
     * @return string
     */
    public function getFullname(): string;

    /**
     * Set fullname.
     *
     * @param string $fullname
     * @return $this
     */
    public function setFullname(string $fullname): self;

    /**
     * Get message email.
     *
     * @return string
     */
    public function getEmail(): string;

    /**
     * Set message email.
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email): self;

    /**
     * Get message text.
     *
     * @return string
     */
    public function getMessage(): string;

    /**
     * Set message text.
     *
     * @param string $message
     *
     * @return $this
     */
    public function setMessage(string $message): self;

    /**
     * Return updated at time.
     *
     * @return string
     */
    public function getUpdatedAt();

    /**
     * Set updated at time.
     *
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTime $date): self;

    /**
     * Return created at time.
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Set created at time.
     *
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $date): self;
}
