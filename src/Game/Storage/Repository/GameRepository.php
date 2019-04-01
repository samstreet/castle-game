<?php

declare(strict_types=1);

namespace App\Game\Storage\Repository;

use Lib\Core\Storage\Entity\Model as Entity;
use Lib\Core\Storage\Repository\RepositoryInterface;

/**
 * Class GameRepository
 * @package Lib\Game\Storage\Repository
 */
class GameRepository implements RepositoryInterface
{
    public function __construct()
    {
        $this->setModel(new Entity());
    }

    /**
     * @inheritDoc
     */
    public function getModel(): Entity
    {
        // TODO: Implement getModel() method.
    }

    /**
     * @inheritDoc
     */
    public function setModel(Entity $model): void
    {
        // TODO: Implement setModel() method.
    }
}
