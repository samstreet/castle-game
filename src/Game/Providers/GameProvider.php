<?php

declare(strict_types=1);

namespace App\Game\Providers;

use Lib\Core\Concerns as CoreConcerns;
use Lib\Core\Providers\Concerns as ProviderConcerns;

/**
 * Class GameProvider
 * @package App\Game\Providers
 */
abstract class GameProvider
{
    use ProviderConcerns\RegistersProviders,
        CoreConcerns\CanAccessProjectRoot,
        ProviderConcerns\RegistersMiddleware;

}
