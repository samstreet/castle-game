<?php

declare(strict_types=1);

namespace Lib\Game\Providers;

use Lib\Core\Concerns as CoreConcerns;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\Yaml\Yaml;

/**
 * Class GameRouteServiceProvider
 * @package Lib\Game\Providers
 */
class GameRouteServiceProvider implements ServiceProviderInterface
{
    use CoreConcerns\CanAccessProjectRoot;

    /**
     * @inheritdoc
     */
    public function register(Container $app)
    {
        $routes = $app['game.config.routes'] = Yaml::parseFile(realpath((__DIR__.'/../config/routes.yaml')));

        /** @var ControllerCollection $controllerCollection */
        $controllerCollection = $app['controllers'];
        foreach ($routes as $name => $route) {
            $controllerCollection->match($route['path'], $route['controller'])
                ->bind($name)
                ->method($route['method'] ?? 'GET');
        }
    }
}