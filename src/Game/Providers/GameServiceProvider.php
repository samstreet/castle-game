<?php

declare(strict_types=1);

namespace App\Game\Providers;

use App\Game\Http\Middleware\GameExistsMiddleware;
use App\Game\Services\GameService;
use App\Game\Storage\Entity\Building;
use App\Game\Storage\Entity\Game;
use App\Game\Storage\Entity\User;
use App\Game\Storage\Repository\GameRepository;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class GameServiceProvider
 * @package Lib\Game\Providers
 */
class GameServiceProvider extends GameProvider implements ServiceProviderInterface
{
    /**
     * @var array
     */
    protected $provides = [
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
    public function register(Container $app)
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
