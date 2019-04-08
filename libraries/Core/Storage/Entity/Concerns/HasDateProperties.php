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
     * @Column(name="created_at", nullable=false, type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    protected $createdAt;

    /**
     * @Column(name="updated_at", nullable=false, type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    protected $updatedAt;

    /**
     * @Column(name="deleted_at", nullable=true, type="datetime", options={"default"="NULL"})
     */
    protected $deletedAt = null;

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
