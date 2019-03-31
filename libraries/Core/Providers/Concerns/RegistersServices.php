<?php

declare(strict_types=1);

namespace Lib\Core\Providers\Concerns;

use Pimple\Container;

/**
 * Trait RegistersServices
 * @package Lib\Core\Providers\Concerns
 */
trait RegistersServices
{
    /**
     * @param array $services
     * @param Container $app
     */
    protected function bindServices(array $services, Container $app): void
    {
        foreach ($services as $name => $service) {
            $app[$name] = $this->resolveService($service);
        }

        dd($app);
    }

    /**
     * @param $service
     * @return callable
     */
    private function resolveService($service): callable
    {
        $class = new \ReflectionClass($service['service']);
        return function() use ($class){
            return $class->newInstance();
        };
    }
}
