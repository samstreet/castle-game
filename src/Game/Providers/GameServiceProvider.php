<?php

declare(strict_types=1);

namespace App\Game\Providers;

use Lib\Core\Concerns as CoreConcerns;
use Lib\Core\Providers\Concerns as ProviderConcerns;
use App\Game\Services\GameService;
use App\Game\Storage\Repository\GameRepository;
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
        DatabaseServiceProvider::class,
        GameRouteServiceProvider::class
    ];

    /**
     * @inheritdoc
     */
    public function register(Container $app)
    {
        $this->registerProviders($app);
        $this->registerEntities($app);
        $this->registerRepositories($app);
        $this->registerServices($app);
    }

    /**
     * @param Container $app
     */
    private function registerEntities(Container $app): void
    {

    }

    /**
     * @param Container $app
     */
    private function registerRepositories(Container $app): void
    {
        $app['game.game.repository'] = function () {
            return new GameRepository();
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