<?php

declare(strict_types=1);

namespace Test\Unit\Game\Services;

use App\Building\Services\BuildingService;
use App\Game\Services\GameService;
use App\Game\Storage\Entity\Castle;
use App\Game\Storage\Entity\Farm;
use App\Game\Storage\Entity\Game;
use App\Game\Storage\Entity\House;
use App\Game\Storage\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class GameService
 * @package Test\Unit\Game\Services
 */
class GameServiceTest extends TestCase
{
    /**
     * @var BuildingService|MockObject
     */
    private $buildingService;

    /**
     * @var GameRepository|MockObject
     */
    private $gameRepository;

    /**
     * @var Session|MockObject
     */
    private $session;

    protected function setUp()
    {
        parent::setUp();
        $this->buildingService = $this->getMockBuilder(BuildingService::class)->disableOriginalConstructor()->getMock();
        $this->gameRepository = $this->getMockBuilder(GameRepository::class)->disableOriginalConstructor()->getMock();
        $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
    }

    /**
     * @covers GameService::makeGame()
     */
    public function testMakeGameGeneratesAGame()
    {
        $service = new GameService($this->gameRepository, $this->buildingService);
        $service->setSession($this->session);

        $this->gameRepository->expects($this->once())->method('createGame')->willReturn(new Game());
        $this->buildingService->expects($this->once())->method('attachBuildingsToGame');
        $this->session->expects($this->once())->method('set');

        $service->makeGame();
    }

    /**
     * @covers GameService::makeGame()
     */
    public function testMakeGameReturnsNullWhenRepositoryFails()
    {
        $service = new GameService($this->gameRepository, $this->buildingService);
        $service->setSession($this->session);

        $this->gameRepository->expects($this->once())->method('createGame')->willReturn(null);
        $this->buildingService->expects($this->never())->method('attachBuildingsToGame');
        $this->session->expects($this->never())->method('set');

        $this->assertNull($service->makeGame());
    }

    /**
     * @covers GameService::findGame()
     */
    public function testFindGameMethodReturnsGameCorrectly()
    {
        $service = new GameService($this->gameRepository, $this->buildingService);
        $service->setSession($this->session);

        $this->gameRepository->expects($this->once())->method('findById')->willReturn(new Game());

        $service->findGame('uuid-uuid-uuid-uuid');
    }

    /**
     * @covers GameService::findGame()
     */
    public function testFindGameMethodReturnsGameCorrectlyWhenGameExistsInSession()
    {
        $service = new GameService($this->gameRepository, $this->buildingService);
        $service->setSession($this->session);

        $uuid = 'uuid-uuid-uuid-uuid';

        $this->session->expects($this->once())->method('get')
            ->with('game.'.$uuid)
            ->willReturn(new Game());

        $this->gameRepository->expects($this->never())->method('findById');

        $service->findGame($uuid);
    }

    /**
     * @covers GameService::canAttack()
     */
    public function testCanAttackReturnsTrueIfAnAttackIsPossibleWhenBuildingsHaveHealth()
    {
        $service = new GameService($this->gameRepository, $this->buildingService);
        $service->setSession($this->session);

        $game = (new Game())->setBuildings(new ArrayCollection([
            new Castle(),
            new Farm(),
            new House(),
        ]));

        $this->assertTrue($service->canAttack($game));
    }

    /**
     * @covers GameService::canAttack()
     */
    public function testCanAttackReturnsFalseWhenBuildingsHaveNoHealth()
    {
        $service = new GameService($this->gameRepository, $this->buildingService);
        $service->setSession($this->session);

        $game = (new Game())->setBuildings(new ArrayCollection([
            (new Castle())->setHealth(0),
            (new Farm())->setHealth(0),
            (new Farm())->setHealth(0),
            (new Farm())->setHealth(0),
            (new Farm())->setHealth(0),
            (new House())->setHealth(0),
            (new House())->setHealth(0),
            (new House())->setHealth(0),
            (new House())->setHealth(0),
        ]));

        $this->assertFalse($service->canAttack($game));
    }

    /**
     * @covers GameService::getStatusForGame()
     */
    public function testGetStatusForGamePopulatesArrayCorrectlyWhenGameIsOngoing()
    {
        $service = new GameService($this->gameRepository, $this->buildingService);
        $service->setSession($this->session);

        $game = (new Game())->setBuildings(new ArrayCollection([
            (new Castle())->setHealth(0),
            (new Farm())->setHealth(10),
            (new House())->setHealth(50),
        ]));

        $status = $service->getStatusForGame($game);

        $this->assertIsArray($status);
        $this->assertArrayHasKey('castle', $status);
        $this->assertArrayHasKey('houses', $status);
        $this->assertArrayHasKey('farms', $status);
        $this->assertArrayHasKey('remaining', $status['farms']);
        $this->assertArrayHasKey('remaining', $status['houses']);
        $this->assertArrayHasKey('status', $status);
        $this->assertArrayHasKey('attackable', $status);
        $this->assertTrue($status['attackable'] === true);
        $this->assertTrue($status['status'] === 'ongoing');
    }

    /**
     * @covers GameService::getStatusForGame()
     */
    public function testGetStatusForGamePopulatesArrayCorrectlyWhenGameIsNotAttackable()
    {
        $service = new GameService($this->gameRepository, $this->buildingService);
        $service->setSession($this->session);

        $game = (new Game())->setBuildings(new ArrayCollection([
            (new Castle())->setHealth(0),
            (new Farm())->setHealth(0),
            (new House())->setHealth(0),
        ]));

        $status = $service->getStatusForGame($game);

        $this->assertIsArray($status);
        $this->assertArrayHasKey('castle', $status);
        $this->assertArrayHasKey('houses', $status);
        $this->assertArrayHasKey('farms', $status);
        $this->assertArrayHasKey('remaining', $status['farms']);
        $this->assertArrayHasKey('remaining', $status['houses']);
        $this->assertArrayHasKey('status', $status);
        $this->assertArrayHasKey('attackable', $status);
        $this->assertTrue($status['attackable'] === false);
        $this->assertTrue($status['status'] === 'finished');
    }
}
