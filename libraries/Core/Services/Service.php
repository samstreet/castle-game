<?php

declare(strict_types=1);

namespace Lib\Core\Services;

use Lib\Core\Storage\Repository\Repository;
use Lib\Core\Storage\Repository\RepositoryInterface;

/**
 * Class Service
 * @package Lib\Core\Services
 */
abstract class Service implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @return RepositoryInterface|null
     */
    protected function getRepository(): ?RepositoryInterface
    {
        return $this->repository;
    }

    /**
     * {@inheritdoc}
     */
    public function setRepository(RepositoryInterface $repository): void
    {
        $this->repository = $repository;
    }
}
