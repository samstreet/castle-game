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
     * @Column(name="id", type="guid")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
