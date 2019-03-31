<?php

declare(strict_types=1);

namespace Lib\Core\Providers;

use Lib\Core\Providers\Concerns as ProviderConcerns;
use Lib\Core\Concerns as CoreConcerns;
use Lib\Core\Services\FooService;
use Lib\Core\Services\TestService;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class CoreServiceProvider
 * @package Lib\Core\Providers
 */
class CoreServiceProvider implements ServiceProviderInterface
{
    use ProviderConcerns\RegistersProviders,
        ProviderConcerns\RegistersServices,
        CoreConcerns\CanAccessProjectRoot;

    /**
     * @var array
     */
    protected $provides = [
        RequestServiceProvider::class,
        RouteServiceProvider::class
    ];

    /**
     * @param Container $app
     */
    public function register(Container $app): void
    {
        $this->registerProviders($app);

        $app['core.foo'] = function() {
            return new FooService();
        };

        $app['core.test'] = function() use ($app) {
            return new TestService($app['core.foo']);
        };
    }
}
