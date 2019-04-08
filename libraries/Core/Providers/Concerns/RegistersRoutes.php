<?php

declare(strict_types=1);

namespace Lib\Core\Providers\Concerns;

use Pimple\Container;
use Silex\Controller;

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
        foreach ($routes as $name => $route) {
            [$controllerBinding, $controllerAction] = explode('::', $route['controller']);
            $method = ($route['method'] ?? ['get']);

            $controller = $app->match($route['path'], [$app[$controllerBinding], $controllerAction])
                ->bind($name)
                ->method(
                    join('|', array_map('strtoupper', $method))
                );

            $this->applyBeforeMiddleware($controller, $app, $route['before'] ?? []);
        }

    }

    /**
     * @param Controller $controller
     * @param Container $app
     * @param array $beforeMiddleware
     * @return Controller
     */
    private function applyBeforeMiddleware(
        Controller $controller,
        Container $app,
        array $beforeMiddleware = []
    ): Controller {
        foreach ($beforeMiddleware as $middleware) {
            $controller->before($app[$middleware]);
        }

        return $controller;
    }
}
