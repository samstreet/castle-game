<?php

declare(strict_types=1);

namespace App\Game\Storage\Repository;

use App\Game\Storage\Entity\Game;
use App\Game\Storage\Repository\Contracts\GameRepositoryContract;
use Exception;
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
    public function findById(string $id): ?Entity
    {
        return $this->getQueryBuilder()
            ->getEntityManager()
            ->find(Game::class, $id);
    }

    /**
     * @inheritDoc
     */
    public function createGame(): ?Game
    {
        try{
            $game = new Game();
            // if we were considering saving game state, this is where we would start
            // $this->save($game);
            return $game;
        } catch (Exception $e) {
            return null;
        }
    }
}
