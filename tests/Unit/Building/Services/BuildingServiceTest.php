<?php

declare(strict_types=1);

namespace Test\Unit\Building\Services;

use App\Building\Services\BuildingService;
use App\Game\Storage\Entity\Castle;
use App\Game\Storage\Entity\Farm;
use App\Game\Storage\Entity\Game;
use App\Game\Storage\Entity\House;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class BuildingServiceTest
 * @package Test\Unit\Building\Services
 */
class BuildingServiceTest extends TestCase
{
    /**
     * @covers BuildingService::attachBuildingsToGame()
     */
    public function testAttachBuildingsToGameMethodPopulatesGameCorrectlyWhenSuppliedEmptyBuildingCollection()
    {
        $service = new BuildingService();
        $game = $service->attachBuildingsToGame(new Game(), new ArrayCollection());

        $this->assertCount(9, $game->getBuildings());
        $houses = $game->getBuildings()->filter(function ($building) {
            return $building instanceof House;
        });

        $farms = $game->getBuildings()->filter(function ($building) {
            return $building instanceof Farm;
        });

        $castles = $game->getBuildings()->filter(function ($building) {
            return $building instanceof Castle;
        });

        $this->assertCount(4, $houses);
        $this->assertCount(4, $farms);
        $this->assertCount(1, $castles);
    }

    /**
     * @covers BuildingService::attachBuildingsToGame()
     */
    public function testAttachBuildingsToGameMethodPopulatesGameCorrectlyWhenSuppliedPopulatedBuildingCollection()
    {
        $service = new BuildingService();
        $game = $service->attachBuildingsToGame(new Game(), new ArrayCollection([
            new Castle(),
            new Farm(),
            new Farm(),
            new Farm(),
            new Farm(),
            new House(),
            new House(),
            new House(),
            new House()
        ]));

        $this->assertCount(9, $game->getBuildings());

        $houses = $game->getBuildings()->filter(function ($building) {
            return $building instanceof House;
        });

        $farms = $game->getBuildings()->filter(function ($building) {
            return $building instanceof Farm;
        });

        $castles = $game->getBuildings()->filter(function ($building) {
            return $building instanceof Castle;
        });

        $this->assertCount(4, $houses);
        $this->assertCount(4, $farms);
        $this->assertCount(1, $castles);
    }

    /**
     * @param $noHouses
     * @param $noFarms
     * @covers       BuildingService::createBuildings()
     * @dataProvider createBuildingsDataProvider
     */
    public function testCreateBuildingsMethodPopulatesAccuratelyWithArguments($noHouses, $noFarms)
    {
        $service = new BuildingService();
        $buildings = $service->createBuildings($noHouses, $noFarms);

        $this->assertCount(($noHouses + $noFarms + 1), $buildings);
        $houses = $buildings->filter(function ($building) {
            return $building instanceof House;
        });

        $farms = $buildings->filter(function ($building) {
            return $building instanceof Farm;
        });

        $castles = $buildings->filter(function ($building) {
            return $building instanceof Castle;
        });

        $this->assertCount($noHouses, $houses);
        $this->assertCount($noFarms, $farms);
        $this->assertCount(1, $castles);
    }

    /**
     * @covers BuildingService::createBuildings()
     */
    public function testCreateBuildingsMethodPopulatesAccuratelyWithNoArguments()
    {
        $service = new BuildingService();
        $buildings = $service->createBuildings();

        $this->assertTrue($buildings->count() === 9);
        $houses = $buildings->filter(function ($building) {
            return $building instanceof House;
        });

        $farms = $buildings->filter(function ($building) {
            return $building instanceof Farm;
        });

        $castles = $buildings->filter(function ($building) {
            return $building instanceof Castle;
        });

        $this->assertCount(4, $houses);
        $this->assertCount(4, $farms);
        $this->assertCount(1, $castles);
    }

    /**
     * @return array
     */
    public function createBuildingsDataProvider(): array
    {
        return [
            [0, 0],
            [2, 3],
            [10, 10],
            [100, 100],
        ];
    }
}
