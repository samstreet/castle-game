<?php

declare(strict_types=1);

namespace Lib\Core\Providers;

use Lib\Core\Concerns as CoreConcerns;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\Yaml\Yaml;

/**
 * Class RouteServiceProvider
 * @package Lib\Core\Providers
 */
class RouteServiceProvider implements ServiceProviderInterface
{
    use CoreConcerns\CanAccessProjectRoot;

    /**
     * @param Container $app
     */
    public function register(Container $app): void
    {
        $routes = $app['core.config.routes'] = Yaml::parseFile(realpath((__DIR__.'/../config/routes.yaml')));

        /** @var ControllerCollection $controllerCollection */
        $controllerCollection = $app['controllers'];
        foreach ($routes as $name => $route) {
            $controllerCollection->match($route['path'], $route['controller'])
                ->bind($name)
                ->method($route['method'] ?? 'GET');
        }
    }
}