<?php

declare(strict_types=1);

namespace App\Game\Services;

use App\Building\Services\Contracts\BuildingServiceContract;
use App\Game\Services\Contracts\GameServiceContract;
use App\Game\Storage\Entity\Building;
use App\Game\Storage\Entity\Game;
use App\Game\Storage\Repository\Contracts;
use Doctrine\Common\Collections\ArrayCollection;
use Lib\Core\Services\Service;

/**
 * Class GameService
 * @package Lib\Game\Services
 */
class GameService extends Service implements GameServiceContract
{
    /**
     * @var BuildingServiceContract
     */
    private $buildingService;

    /**
     * GameService constructor.
     * @param Contracts\GameRepositoryContract $gameRepository
     * @param BuildingServiceContract $buildingService
     */
    public function __construct(Contracts\GameRepositoryContract $gameRepository, BuildingServiceContract $buildingService)
    {
        $this->setRepository($gameRepository);
        $this->buildingService = $buildingService;
    }

    /**
     * @inheritDoc
     */
    public function makeGame(array $attributes = []): ?Game
    {
        /** @var Game|null $game */
        if($game = $this->getRepository()->createGame($attributes)){
            $game = $this->buildingService->attachBuildingsToGame($game, new ArrayCollection());
            $this->session->set("game.{$game->getId()}", $game);
        }

        return $game;
    }

    /**
     * @inheritDoc
     */
    public function findGame(string $uuid): ?Game
    {
        if($game = $this->session->get("game.{$uuid}")){
            return $game;
        }

        return $this->getRepository()->findById($uuid);
    }

    /**
     * @inheritDoc
     */
    public function attack(Game $game): bool
    {
        if(!$this->canAttack($game)){
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function canAttack(Game $game): bool
    {
        /** @var Building $building */
        $buildings = $game->getBuildings()->filter(function(Building $building){
            return $building->getHealth() > 0;
        });

        return !$buildings->isEmpty();
    }


}
