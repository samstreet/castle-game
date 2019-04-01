<?php

declare(strict_types=1);

namespace Lib\Core\Storage\Entity\Concerns;

/**
 * Trait HasDateProperties
 * @package Lib\Core\Storage\Entity\Concerns
 */
trait HasDateProperties
{
    /**
     * @Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @Column(name="deleted_at", type="datetime")
     */
    private $deletedAt;

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeletedAt(): ?\DateTime
    {
        return $this->deletedAt;
    }
}
