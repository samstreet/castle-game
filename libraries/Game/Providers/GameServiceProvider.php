<?php

declare(strict_types=1);

namespace Lib\Game\Providers;

use Pimple\ServiceProviderInterface;
use Pimple\Container;
use Lib\Core\Providers\Concerns as ProviderConcerns;
use Lib\Core\Concerns as CoreConcerns;

/**
 * Class GameServiceProvider
 * @package Lib\Game\Providers
 */
class GameServiceProvider implements ServiceProviderInterface
{
    use ProviderConcerns\RegistersProviders,
        CoreConcerns\CanAccessProjectRoot;

    /**
     * @var array
     */
    protected $provides = [
        GameRouteServiceProvider::class
    ];

    /**
     * @inheritdoc
     */
    public function register(Container $app)
    {
        $this->registerProviders($app);
    }

}