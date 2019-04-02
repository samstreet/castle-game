<?php

declare(strict_types=1);

namespace App\Game\Storage\Repository;

use App\Game\Storage\Entity\Game;
use App\Game\Storage\Repository\Contracts\GameRepositoryContract;
use Lib\Core\Storage\Entity\Model as Entity;
use Lib\Core\Storage\Repository\Repository;

/**
 * Class GameRepository
 * @package Lib\Game\Storage\Repository
 */
class GameRepository extends Repository implements GameRepositoryContract
{
    /**
     * GameRepository constructor.
     * @param Game $entity
     */
    public function __construct(Game $entity)
    {
        $this->setModel($entity);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Entity
    {
        return $this->getQueryBuilder()
            ->getEntityManager()
            ->find(Game::class, $id);
    }

    /**
     * @inheritDoc
     */
    public function createGame(array $attributes = []): ?Game
    {
        try{
            $game = new Game();
            $this->save($game);

            return $game;
        } catch (\Exception $e) {
            return null;
        }
    }
}
