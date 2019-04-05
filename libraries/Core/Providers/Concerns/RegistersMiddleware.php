<?php

declare(strict_types=1);

namespace Lib\Core\Providers\Concerns;

use Pimple\Container;

/**
 * Class RegistersMiddleware
 * @package Lib\Core\Providers\Concerns
 */
trait RegistersMiddleware
{
    /**
     * @var array
     */
    protected $middleware = [];

    /**
     * @param Container $app
     */
    abstract public function registerMiddleware(Container $app): void;
}
