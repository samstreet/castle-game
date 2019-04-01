<?php

declare(strict_types=1);

namespace App\Game\Providers;

use Lib\Core\Providers\Concerns as ProviderConcerns;
use App\Game\Http\Controllers\GameController;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class GameRouteServiceProvider
 * @package Lib\Game\Providers
 */
class GameRouteServiceProvider implements ServiceProviderInterface
{
    use ProviderConcerns\RegistersRoutes;

    /**
     * @inheritdoc
     */
    public function register(Container $app)
    {
        $routes = $app['game.config.routes'] = Yaml::parseFile(realpath((__DIR__ . '/../config/routes.yaml')));
        $this->bindControllers($app);
        $this->bindRoutes($routes, $app);
    }

    /**
     * @param Container $app
     * @return void
     */
    private function bindControllers(Container $app): void
    {
        $app['game.home.controller'] = function () {
            return new GameController();
        };
    }
}