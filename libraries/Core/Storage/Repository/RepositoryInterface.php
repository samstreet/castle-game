<?php

declare(strict_types=1);

namespace Lib\Core\Storage\Repository;

use Doctrine\ORM\QueryBuilder;
use Lib\Core\Storage\Entity\Model;

/**
 * Interface RepositoryInterface
 * @package Lib\Core\Storage\Repository
 */
interface RepositoryInterface
{
    /**
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): ?Model;

    /**
     * @param Model $model
     * @return bool
     */
    public function save(Model $model): bool;

    /**
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool;

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder(): QueryBuilder;

    /**
     * @param QueryBuilder $builder
     * @return RepositoryInterface
     */
    public function setQueryBuilder(QueryBuilder $builder): RepositoryInterface;

    /**
     * @return Model
     */
    public function getModel() : Model;

    /**
     * @param Model $model
     * @return void
     */
    public function setModel(Model $model) : void;
}