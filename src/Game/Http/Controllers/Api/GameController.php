<?php

declare(strict_types=1);

namespace App\Game\Http\Controllers\Api;

use App\Game\Services\Contracts\GameServiceContract;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Sam Street
 */
class GameController
{
    /**
     * @var GameServiceContract
     */
    private $gameService;

    /**
     * GameController constructor.
     * @param GameServiceContract $gameService
     */
    public function __construct(GameServiceContract $gameService)
    {
        $this->gameService = $gameService;
    }


    public function createAction(Request $request):JsonResponse
    {
        $game = $this->gameService->makeGame();
        return new JsonResponse($game ?? null);
    }
}