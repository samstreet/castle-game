<?php

declare(strict_types=1);

namespace App\Game\Services;

use App\Game\Services\Contracts\GameServiceContract;
use App\Game\Storage\Entity\Game;
use App\Game\Storage\Repository\Contracts;
use Lib\Core\Services\Service;

/**
 * Class GameService
 * @package Lib\Game\Services
 */
class GameService extends Service implements GameServiceContract
{
    /**
     * GameService constructor.
     * @param Contracts\GameRepositoryContract $gameRepository
     */
    public function __construct(Contracts\GameRepositoryContract $gameRepository)
    {
        $this->setRepository($gameRepository);
    }

    /**
     * @inheritDoc
     */
    public function makeGame(array $attributes = []): ?Game
    {
        return $this->getRepository()->createGame($attributes);
    }
}
