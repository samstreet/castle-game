<?php

declare(strict_types=1);

namespace App\Game\Providers;

use App\Game\Services\GameService;
use App\Game\Storage\Entity\Building;
use App\Game\Storage\Entity\Game;
use App\Game\Storage\Entity\User;
use App\Game\Storage\Repository\GameRepository;
use Lib\Core\Concerns as CoreConcerns;
use Lib\Core\Providers\Concerns as ProviderConcerns;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class GameServiceProvider
 * @package Lib\Game\Providers
 */
class GameServiceProvider implements ServiceProviderInterface
{
    use ProviderConcerns\RegistersProviders,
        CoreConcerns\CanAccessProjectRoot;

    /**
     * @var array
     */
    protected $provides = [
        GameRouteServiceProvider::class
    ];

    /**
     * @inheritdoc
     */
    public function register(Container $app)
    {
        $this->registerEntities($app);
        $this->registerRepositories($app);
        $this->registerServices($app);
        $this->registerProviders($app);
    }

    /**
     * @param Container $app
     */
    private function registerEntities(Container $app): void
    {
        $app['game.game.entity'] = function() {
            return new Game();
        };

        $app['game.building.entity'] = function() {
            return new Building();
        };

        $app['game.user.entity'] = function() {
            return new User();
        };
    }

    /**
     * @param Container $app
     */
    private function registerRepositories(Container $app): void
    {
        $queryBuilder = $app['orm.em']->createQueryBuilder();
        $app['game.game.repository'] = function () use ($app, $queryBuilder) {
            return (new GameRepository($app['game.game.entity']))->setQueryBuilder($queryBuilder);
        };
    }

    /**
     * @param Container $app
     */
    private function registerServices(Container $app): void
    {
        $app['game.game.service'] = function () use ($app) {
            return new GameService($app['game.game.repository']);
        };
    }
}