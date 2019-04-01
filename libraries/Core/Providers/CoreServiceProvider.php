<?php

declare(strict_types=1);

namespace Lib\Core\Providers;

use Lib\Core\Providers\Concerns as ProviderConcerns;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class CoreServiceProvider
 * @package Lib\Core\Providers
 */
class CoreServiceProvider implements ServiceProviderInterface
{
    use ProviderConcerns\RegistersProviders,
        ProviderConcerns\RegistersServices;

    /**
     * @var array
     */
    protected $provides = [
        RouteServiceProvider::class
    ];

    /**
     * @param Container $app
     */
    public function register(Container $app): void
    {
        $this->registerProviders($app);
    }
}
