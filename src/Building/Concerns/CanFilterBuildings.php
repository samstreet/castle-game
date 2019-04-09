<?php

declare(strict_types=1);

namespace App\Building\Concerns;

use App\Game\Storage\Entity\Building;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Trait CanFilterBuildings
 * @package App\Building\Concerns
 */
trait CanFilterBuildings
{
    /**
     * @param ArrayCollection $buildings
     * @return ArrayCollection
     */
    public function filterBuildingsByHealth(ArrayCollection $buildings): ArrayCollection
    {
        return $buildings->filter(function(Building $building){
            return $building->getHealth() > 0;
        });
    }

    /**
     * @param ArrayCollection $buildings
     * @param $type
     * @return ArrayCollection
     */
    public function filterBuildingByType(ArrayCollection $buildings, $type): ArrayCollection
    {
        return $buildings->filter(function (Building $building) use ($type) {
            return $building instanceof $type;
        });
    }
}
