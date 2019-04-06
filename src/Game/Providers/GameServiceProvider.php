<?php

declare(strict_types=1);

namespace App\Game\Providers;

use App\Building\Providers as BuildingProviders;
use App\Game\Http\Middleware\GameExistsMiddleware;
use App\Game\Services\GameService;
use App\Game\Storage\Entity;
use App\Game\Storage\Repository\GameRepository;
use Lib\Core\Providers\CoreProvider;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class GameServiceProvider
 * @package Lib\Game\Providers
 */
class GameServiceProvider extends CoreProvider implements ServiceProviderInterface
{
    /**
     * @var array
     */
    protected $provides = [
        BuildingProviders\BuildingServiceProvider::class,
        GameRouteServiceProvider::class
    ];

    /**
     * @var array
     */
    protected $middleware = [
        'middleware.game.exists' => GameExistsMiddleware::class
    ];

    /**
     * @inheritdoc
     */
    public function register(Container $app): void
    {
        $this->registerMiddleware($app);
        $this->registerEntities($app);
        $this->registerRepositories($app);
        $this->registerServices($app);
        $this->registerProviders($app);
    }

    /**
     * @inheritDoc
     */
    public function registerMiddleware(Container $app): void
    {
        foreach ($this->middleware as $binding => $middleware) {
            $app[$binding] = function () use ($app, $middleware) {
                return (new $middleware());
            };
        }
    }

    /**
     * @param Container $app
     */
    private function registerEntities(Container $app): void
    {
        $app['game.game.entity'] = function() {
            return new Entity\Game();
        };

        $app['game.castle.entity'] = function() {
            return new Entity\Castle();
        };

        $app['game.house.entity'] = function() {
            return new Entity\House();
        };

        $app['game.farm.entity'] = function() {
            return new Entity\Farm();
        };

        $app['game.user.entity'] = function() {
            return new Entity\User();
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
            return (new GameService($app['game.game.repository'], $app['game.building.service']))
                ->setSession($app['session']);
        };
    }
}
