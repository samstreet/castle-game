<?php

declare(strict_types=1);

namespace App\Building\Services\Contracts;

use App\Game\Storage\Entity\Game;
use Doctrine\Common\Collections\ArrayCollection;
use Lib\Core\Services\ServiceInterface;

/**
 * Interface BuildingServiceContract
 * @package App\Building\Services\Contracts
 */
interface BuildingServiceContract extends ServiceInterface
{
    /**
     * @param Game $game
     * @param ArrayCollection $buildings
     * @return Game
     */
    public function attachBuildingsToGame(Game $game, ArrayCollection $buildings): Game;

    /**
     * @return ArrayCollection
     */
    public function createBuildings($houses = 4, $farms = 4): ArrayCollection;
}
