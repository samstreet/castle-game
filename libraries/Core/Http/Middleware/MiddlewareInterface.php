<?php

declare(strict_types=1);

namespace Lib\Core\Http\Middleware;

use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface MiddlewareInterface
 * @package Lib\Core\Http\Middleware
 */
interface MiddlewareInterface
{
    /**
     * @param Request $request
     * @param Container $app
     */
    public function __invoke(Request $request, Container $app);
}
