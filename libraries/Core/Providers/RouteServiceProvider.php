<?php

declare(strict_types=1);

namespace Lib\Core\Providers;

use Lib\Core\Http\Controllers\HomeController;
use Lib\Core\Providers\Concerns as ProviderConcerns;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class RouteServiceProvider
 * @package Lib\Core\Providers
 */
class RouteServiceProvider implements ServiceProviderInterface
{
    use ProviderConcerns\RegistersRoutes;

    /**
     * @param Container $app
     */
    public function register(Container $app): void
    {
        $routes = $app['core.config.routes'] = Yaml::parseFile(realpath((__DIR__ . '/../config/routes.yaml')));

        $app['core.home.controller'] = function() use ($app){
            return new HomeController();
        };

        $this->bindRoutes($routes, $app);
    }
}