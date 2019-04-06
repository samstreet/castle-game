<?php

declare(strict_types=1);

namespace Lib\Core\Providers;

use Lib\Core\Concerns as CoreConcerns;
use Lib\Core\Providers\Concerns as ProviderConcerns;
use Pimple\Container;

/**
 * Class GameProvider
 * @package App\Game\Providers
 */
abstract class CoreProvider
{
    use ProviderConcerns\RegistersProviders,
        CoreConcerns\CanAccessProjectRoot,
        ProviderConcerns\RegistersMiddleware;

    /**
     * @param Container $app
     */
    abstract public function register(Container $app): void;
}
