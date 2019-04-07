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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request):JsonResponse
    {
        return new JsonResponse($this->gameService->makeGame() ?? null);
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
        $canAttack = $this->gameService->canAttack($game);

        if($canAttack){
            $this->gameService->attack($game);
        }

        return new JsonResponse();
    }
}