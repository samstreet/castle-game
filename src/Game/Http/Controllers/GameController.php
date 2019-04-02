<?php

declare(strict_types=1);

namespace App\Game\Http\Controllers;

use App\Game\Services\Contracts\GameServiceContract;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeController
 * @package Lib\Core\Http\Controllers
 */
class GameController
{
    protected $gameService;

    /**
     * GameController constructor.
     * @param GameServiceContract $gameService
     */
    public function __construct(GameServiceContract $gameService)
    {
        $this->gameService = $gameService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function indexAction(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}
