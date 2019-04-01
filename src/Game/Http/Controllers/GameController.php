<?php

declare(strict_types=1);

namespace App\Game\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeController
 * @package Lib\Core\Http\Controllers
 */
class GameController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function indexAction(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}
