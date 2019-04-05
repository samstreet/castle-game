<?php

declare(strict_types=1);

namespace Lib\Core\Providers\Concerns;

use Pimple\Container;

/**
 * Trait RegistersProviders
 * @package Lib\Core\Providers\Concerns
 */
trait RegistersProviders
{
    /**
     * @var array
     */
    protected $provides = [];

    /**
     * @param Container $app
     * @return void
     */
    protected function registerProviders(Container $app): void
    {
        foreach ($this->provides as $provider) {
            (new $provider())->register($app);
        }
    }
}