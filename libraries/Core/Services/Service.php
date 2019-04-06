<?php

declare(strict_types=1);

namespace Lib\Core\Services;

use Lib\Core\Storage\Repository\Repository;
use Lib\Core\Storage\Repository\RepositoryInterface;
use Symfony\Component\HttpFoundation\Session\Session;

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
     * @var Session
     */
    protected $session;

    /**
     * @return mixed
     */
    public function getSession(): Session
    {
        return $this->session;
    }

    /**
     * @param Session $session
     * @return Service
     */
    public function setSession(Session $session): self
    {
        $this->session = $session;
        return $this;
    }

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
