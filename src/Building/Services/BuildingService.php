<?php

declare(strict_types=1);

namespace App\Building\Services;

use App\Building\Services\Contracts\BuildingServiceContract;
use App\Game\Storage\Entity\Castle;
use App\Game\Storage\Entity\Farm;
use App\Game\Storage\Entity\Game;
use App\Game\Storage\Entity\House;
use Doctrine\Common\Collections\ArrayCollection;
use Lib\Core\Services\Service;

/**
 * Class BuildingService
 * @package App\Building\Services
 */
class BuildingService extends Service implements BuildingServiceContract
{
    /**
     * @inheritDoc
     */
    public function attachBuildingsToGame(Game $game, ArrayCollection $buildings): Game
    {
        if($buildings->isEmpty()){
            $buildings = $this->createBuildings();
        }

        return $game->setBuildings($buildings);
    }

    /**
     * @inheritDoc
     */
    public function createBuildings($houses = 4, $farms = 4): ArrayCollection
    {
        $buildings = new ArrayCollection();
        $buildings->add(new Castle());

        for($i = 0; $i<$houses; $i++){
            $buildings->add(new House());
        }

        for($i = 0; $i<$farms; $i++){
            $buildings->add(new Farm());
        }

        return $buildings;
    }
}
