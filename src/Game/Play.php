<?php

namespace Game;

use Building\Castle;
use Building\Farm;
use Building\House;

/**
 * Class Play
 * @package Game
 */
class Play {
    /**
     * @var array
     */
    private $buildings = [];

    /**
     * Play constructor.
     * @param int $castleCount
     * @param int $houseCount
     * @param int $farmCount
     */
    public function __construct($castleCount = 1, $houseCount =2, $farmCount = 3)
    {
        $this->buildCity($houseCount);
    }

    /**
     * @param int $repeat
     */
    public function attack ($repeat = 1) {
        for ($i=0; $i < $repeat; $i++) {
            $building = $this->buildings[array_rand($this->buildings)];
            $building->hit();
        }
    }

    /**
     * @param $houseCount
     */
    protected function buildCity($houseCount)
    {
        $this->buildings[] = new Castle();
        for ($i = 0; $i < $houseCount; $i++) {
            $this->buildings[] = new House();
        }
        for ($i = 0; $i < $houseCount; $i++) {
            $this->buildings[] = new Farm();
        }
    }

    /**
     * @return array
     */
    public function getBuildings()
    {
        return $this->buildings;
    }
}
