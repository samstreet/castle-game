<?php

declare(strict_types=1);

namespace App\Game\Http\Middleware;

use App\Game\Services\Contracts\GameServiceContract;
use Lib\Core\Http\Middleware\MiddlewareInterface;
use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GameExistsMiddleware
 * @package App\Game\Http\Middleware
 * @codeCoverageIgnore
 */
class GameExistsMiddleware implements MiddlewareInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(Request $request, Container $app)
    {
        /** @var $gameService GameServiceContract */
        $gameService = $app['game.game.service'];
        if (!$gameService->findGame($request->attributes->get('uuid'))) {
            return $app->json(array('error' => 'Game Not Found'), Response::HTTP_NOT_FOUND);
        }
    }
}
