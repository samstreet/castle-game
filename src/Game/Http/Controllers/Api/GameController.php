<?php

declare(strict_types=1);

namespace App\Game\Http\Controllers\Api;

use App\Game\Services\Contracts\GameServiceContract;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request):JsonResponse
    {
        $game = $this->gameService->makeGame();
        $status = $this->gameService->getStatusForGame($game);
        return new JsonResponse( $game ? $status : null, $game ? Response::HTTP_CREATED : Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function viewAction(Request $request):JsonResponse
    {
        $game = $this->gameService->findGame($request->attributes->get('uuid'));
        $status = $this->gameService->getStatusForGame($game);
        return new JsonResponse($status);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function attackAction(Request $request):JsonResponse
    {
        $game = $this->gameService->findGame($request->attributes->get('uuid'));
        return new JsonResponse($this->gameService->attack($game));
    }
}