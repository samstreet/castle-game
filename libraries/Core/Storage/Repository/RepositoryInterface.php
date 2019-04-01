<?php

declare(strict_types=1);

namespace Lib\Core\Storage\Repository;

use Lib\Core\Storage\Entity\Model;

/**
 * Interface RepositoryInterface
 * @package Lib\Core\Storage\Repository
 */
interface RepositoryInterface
{
    /**
     * @return Model
     */
    public function getModel() : Model;

    /**
     * Set the repository model.
     *
     * @param Model $model
     *
     * @return void
     */
    public function setModel(Model $model) : void;
}