<?php

declare(strict_types=1);

namespace App\Game\Http\Controllers\Api;

use App\Game\Services\Contracts\GameServiceContract;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
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
    public function createAction(Request $request): JsonResponse
    {
        $game = $this->gameService->makeGame();
        $status = $this->gameService->getStatusForGame($game);
        return new JsonResponse($game ? $status : null,
            $game ? Response::HTTP_CREATED : Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function viewAction(Request $request): JsonResponse
    {
        $game = $this->gameService->findGame($request->attributes->get('uuid'));
        $status = $this->gameService->getStatusForGame($game);
        return new JsonResponse($status);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function attackAction(Request $request): JsonResponse
    {
        $game = $this->gameService->findGame($request->attributes->get('uuid'));
        if (!$this->gameService->canAttack($game)) {
            return new JsonResponse($this->gameService->getStatusForGame($game), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($this->gameService->attack($game));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function allAction(Request $request): JsonResponse
    {
        $filters = new ParameterBag($request->query->all());
        $games = $this->gameService->allAvailableSessions($filters);

        /**
         * ideally we would use some sort of paginator here
         * but it seems a little out of scope for a test.
         */
        return new JsonResponse([
            'count' => $games->count(),
            'games' => $games->toArray()
        ]);
    }
}
