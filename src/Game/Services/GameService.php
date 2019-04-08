<?php

declare(strict_types=1);

namespace App\Game\Services;

use App\Building\Services\Contracts as BuildingContracts;
use App\Game\Services\Contracts\GameServiceContract;
use App\Game\Storage\Entity\Building;
use App\Game\Storage\Entity\Castle;
use App\Game\Storage\Entity\Farm;
use App\Game\Storage\Entity\Game;
use App\Game\Storage\Entity\House;
use App\Game\Storage\Repository\Contracts as GameContracts;
use Doctrine\Common\Collections\ArrayCollection;
use Lib\Core\Services\Service;

/**
 * Class GameService
 * @package Lib\Game\Services
 */
class GameService extends Service implements GameServiceContract
{
    /**
     * @var BuildingContracts\BuildingServiceContract
     */
    private $buildingService;

    /**
     * GameService constructor.
     * @param GameContracts\GameRepositoryContract $gameRepository
     * @param BuildingContracts\BuildingServiceContract $buildingService
     */
    public function __construct(
        GameContracts\GameRepositoryContract $gameRepository,
        BuildingContracts\BuildingServiceContract $buildingService
    ) {
        $this->setRepository($gameRepository);
        $this->buildingService = $buildingService;
    }

    /**
     * @inheritDoc
     */
    public function makeGame(): ?Game
    {
        /** @var Game|null $game */
        if ($game = $this->getRepository()->createGame()) {
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
        if ($game = $this->session->get("game.{$uuid}")) {
            return $game;
        }

        return $this->getRepository()->findById($uuid);
    }

    /**
     * @inheritDoc
     */
    public function attack(Game $game): array
    {
        if (!$this->canAttack($game)) {
            return [];
        }

        $selectedBuilding =  $this->buildingService->selectBuilding($game->getBuildings());
        if($isHit = (rand(1, 10)) > 1) {
            $this->buildingService->hitBuilding($selectedBuilding);
        }

        $status = $this->getStatusForGame($game);
        return [
            'attack' => [
                'building' => $selectedBuilding->getBuildingType(),
                'hit' => $isHit
            ],
            'status' => $status
        ];
    }

    /**
     * @inheritDoc
     */
    public function canAttack(Game $game): bool
    {
        /** @var Building $building */
        $buildings = $game->getBuildings()->filter(function (Building $building) {
            return $building->getHealth() > 0;
        });

        return !$buildings->isEmpty();
    }

    /**
     * @inheritDoc
     */
    public function getStatusForGame(Game $game): array
    {
        $castleStatus = $this->filterBuildingByType($game->getBuildings(), Castle::class)->toArray();

        $farmsStatus = $this->filterBuildingByType($game->getBuildings(), Farm::class)->filter(function(Farm $farm) {
            return $farm->getHealth() > 0;
        });

        $houseStatus = $this->filterBuildingByType($game->getBuildings(), House::class)->filter(function(House $house) {
            return $house->getHealth() > 0;
        });

        $canBeAttacked = $this->canAttack($game);

        return [
            'status' => $canBeAttacked != [] ? 'ongoing' : 'finished',
            'attackable' => $canBeAttacked,
            'castle' => $castleStatus,
            'farms' => [
                'remaining' => $farmsStatus->count()
            ],
            'houses' => [
                'remaining' => $houseStatus->count()
            ]
        ];
    }

    /**
     * @param ArrayCollection $buildings
     * @param $type
     * @return ArrayCollection
     */
    private function filterBuildingByType(ArrayCollection $buildings, $type): ArrayCollection
    {
        return $buildings->filter(function (Building $building) use ($type) {
            return $building instanceof $type;
        });
    }
}
