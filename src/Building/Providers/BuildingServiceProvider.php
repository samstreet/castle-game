<?php

declare(strict_types=1);

namespace App\Building\Providers;

use App\Building\Services\BuildingService;
use Lib\Core\Providers\CoreProvider;
use Pimple\Container;

/**
 * Class BuildingServiceProvider
 * @package App\Building\Providers
 */
class BuildingServiceProvider extends CoreProvider
{
    /**
     * @inheritDoc
     */
    public function register(Container $app): void
    {
        $this->registerServices($app);
    }

    /**
     * @inheritDoc
     */
    public function registerMiddleware(Container $app): void
    {
        return;
    }

    /**
     * @param Container $app
     */
    private function registerServices(Container $app): void
    {
        $app['game.building.service'] = function () use ($app) {
            return new BuildingService();
        };
    }
}
