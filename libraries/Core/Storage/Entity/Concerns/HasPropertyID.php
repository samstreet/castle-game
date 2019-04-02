<?php

declare(strict_types=1);

namespace Lib\Core\Storage\Entity\Concerns;

use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;

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
