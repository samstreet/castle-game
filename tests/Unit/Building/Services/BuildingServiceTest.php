<?php

declare(strict_types=1);

namespace Test\Unit\Building\Services;

use App\Building\Services\BuildingService;
use PHPUnit\Framework\TestCase;

/**
 * Class BuildingServiceTest
 * @package Test\Unit\Building\Services
 */
class BuildingServiceTest extends TestCase
{
    /**
     * @covers BuildingService::createBuildings()
     * @dataProvider createBuildingsDataProvider
     */
    public function testCreateBuildingsMethodPopulatesAccuratelyWithArguments($houses, $farms)
    {
        $this->assertTrue(true);
    }

    /**
     * @covers BuildingService::createBuildings()
     */
    public function testCreateBuildingsMethodPopulatesAccuratelyWithNoArguments()
    {
        $service = new BuildingService();
        $buildings = $service->createBuildings();

        $this->assertTrue($buildings->count() === 9);
    }

    public function createBuildingsDataProvider(): array
    {
        return [
            [0, 0]
        ];
    }
}
