<?php

declare(strict_types=1);

namespace Test\Unit\Building\Concerns;

use App\Building\Concerns\CanFilterBuildings;
use App\Game\Storage\Entity\Castle;
use App\Game\Storage\Entity\Farm;
use App\Game\Storage\Entity\House;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class TestCanFilterBuildings
 * @package Test\Unit\Building\Concerns
 */
class CanFilterBuildingsTest extends TestCase
{
    /**
     * @covers       \App\Building\Concerns\CanFilterBuildings::filterBuildingsByHealth()
     * @dataProvider filterByHealthDataProvider
     * @param ArrayCollection $buildings
     * @param int $expectedCount
     */
    public function testFilterBuildingsByHealthCanFilterBuildingsWithHealthGreaterThan0(ArrayCollection $buildings, int $expectedCount)
    {
        /** @var CanFilterBuildings|MockObject $trait */
        $trait = $this->getMockForTrait(CanFilterBuildings::class);
        $this->assertCount($expectedCount, $trait->filterBuildingsByHealth($buildings));
    }

    /**
     * @covers \App\Building\Concerns\CanFilterBuildings::filterBuildingByType
     * @dataProvider filterByTypeDataProvider
     * @param ArrayCollection $buildings
     * @param string $type
     * @param int $expectedCount
     */
    public function testFilterBuildingByTypeFiltersBuildingsByTheirTypeCorrectly(ArrayCollection $buildings, string $type, int $expectedCount)
    {
        /** @var CanFilterBuildings|MockObject $trait */
        $trait = $this->getMockForTrait(CanFilterBuildings::class);
        $this->assertCount($expectedCount, $trait->filterBuildingByType($buildings, $type));
    }

    /**
     * @return array
     */
    public function filterByHealthDataProvider(): array
    {
        return [
            [new ArrayCollection([new Castle(), new Farm(), (new House())->setHealth(0)]), 2],
            [new ArrayCollection([new Castle(), (new House())->setHealth(0), (new House())->setHealth(0)]), 1],
            [new ArrayCollection([(new Castle())->setHealth(0), (new House())->setHealth(0), (new House())->setHealth(0)]), 0],
        ];
    }

    /**
     * @return array
     */
    public function filterByTypeDataProvider(): array
    {
        return [
            [new ArrayCollection([new Castle(), new Farm(), new Farm()]), Farm::class, 2],
            [new ArrayCollection([new Castle(), new House(), new Farm()]), Farm::class, 1],
            [new ArrayCollection([new Castle(), new House(), new Farm()]), House::class, 1],
            [new ArrayCollection([new Castle(), new House(), new Farm(), new House(), new Farm(), new House(), new Farm()]), House::class, 3],
        ];
    }
}
