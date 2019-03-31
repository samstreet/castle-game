<?php

declare(strict_types=1);

namespace Lib\Game\Providers;

use Lib\Core\Providers\Concerns as ProviderConcerns;
use Lib\Game\Http\Controllers\HomeController;
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
        $routes = $app['game.config.routes'] = Yaml::parseFile(realpath((__DIR__.'/../config/routes.yaml')));

        $app['game.home.controller'] = function() use ($app){
            return new HomeController($app['core.test']);
        };

        $this->bindRoutes($routes, $app);
    }
}