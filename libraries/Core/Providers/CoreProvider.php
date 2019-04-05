<?php

declare(strict_types=1);

namespace Lib\Core\Providers;

use Lib\Core\Concerns as CoreConcerns;
use Lib\Core\Providers\Concerns as ProviderConcerns;

/**
 * Class GameProvider
 * @package App\Game\Providers
 */
abstract class CoreProvider
{
    use ProviderConcerns\RegistersProviders,
        CoreConcerns\CanAccessProjectRoot,
        ProviderConcerns\RegistersMiddleware;

}
