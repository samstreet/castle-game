<?php

declare(strict_types=1);

namespace Lib\Core\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeController
 * @package Lib\Core\Http\Controllers
 */
class HomeController
{
    public function indexAction(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}