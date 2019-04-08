<?php

declare(strict_types=1);

namespace Lib\Core\Storage\Entity\Concerns;

/**
 * Trait HasPropertyID
 * @package Lib\Core\Storage\Entity\Concerns
 */
trait HasPropertyID
{
    /**
     * @Id
     * @Column(name="id", type="guid")
     * @GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
