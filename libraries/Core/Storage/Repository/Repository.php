<?php

declare(strict_types=1);

namespace Lib\Core\Storage\Repository;

use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use Lib\Core\Storage\Entity\Model as Entity;

/**
 * Class Repository
 * @package Lib\Core\Storage\Repository
 */
abstract class Repository implements RepositoryInterface
{
    /**
     * @var Entity
     */
    protected $entity;

    /**
     * @var QueryBuilder
     */
    protected $entityManager;

    /**
     * @inheritDoc
     */
    public function getModel(): Entity
    {
        return $this->entity;
    }

    /**
     * @inheritDoc
     */
    public function setModel(Entity $entity): void
    {
        $this->entity = $entity;
    }

    /**
     * @inheritDoc
     */
    public function getQueryBuilder(): QueryBuilder
    {
        return $this->entityManager;
    }

    /**
     * @inheritDoc
     */
    public function setQueryBuilder(QueryBuilder $builder): RepositoryInterface
    {
        $this->entityManager = $builder;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function save(Entity $model): bool
    {
        try {
            $this->getQueryBuilder()->getEntityManager()->persist($model);
            $this->getQueryBuilder()->getEntityManager()->flush();
            $this->getQueryBuilder()->getEntityManager()->clear();

            return true;
        } catch (ORMException $exception) {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(Entity $model): bool
    {
        try {
            $this->getQueryBuilder()->getEntityManager()->remove($model);
            $this->getQueryBuilder()->getEntityManager()->flush();

            return true;
        } catch (ORMException $exception) {
            return false;
        }
    }
}
