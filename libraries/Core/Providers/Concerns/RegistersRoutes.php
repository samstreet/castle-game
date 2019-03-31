<?php

declare(strict_types=1);

namespace Lib\Core\Providers\Concerns;

use Pimple\Container;
use Silex\ControllerCollection;

/**
 * Trait RegistersRoutes
 * @package Lib\Core\Providers\Concerns
 */
trait RegistersRoutes
{
    /**
     * @param array $routes
     * @param Container $app
     */
    protected function bindRoutes(array $routes, Container $app)
    {
        /** @var ControllerCollection $controllerCollection */
        $controllerCollection = $app['controllers'];
        foreach ($routes as $name => $route) {
            $method = strtolower($route['method']);
            $controllerCollection
                ->$method($route['path'], [$app[$route['controller']], $route['action']])
                ->bind($name);
        }
    }
}
