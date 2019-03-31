<?php

declare(strict_types=1);

namespace Lib\Core\Providers;

use Lib\Core\Providers\Concerns as ProviderConcerns;
use Lib\Core\Concerns as CoreConcerns;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class CoreServiceProvider
 * @package Lib\Core\Providers
 */
class CoreServiceProvider implements ServiceProviderInterface
{
    use ProviderConcerns\RegistersProviders,
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
        $this->registerServices($app);
    }

    /**
     * @param Container $app
     */
    private function registerServices(Container $app): void
    {

    }
}
