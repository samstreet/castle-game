<?php

declare(strict_types=1);

namespace App\Game\Http\Middleware;

use Pimple\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ValidFilteringParameters
 * @package App\Game\Http\Middleware
 */
class ValidFilteringParameters
{
    /**
     * @param Request $request
     * @param Container $app
     * @return JsonResponse
     */
    public function __invoke(Request $request, Container $app)
    {
        $allowedFilters = ['status'];
        $filters = $request->query->keys();
        foreach ($filters as $filter) {
            if (!in_array($filter, $allowedFilters)) {
                return new JsonResponse(["error" => "Invalid Filtering Parameter"], Response::HTTP_BAD_REQUEST);
            }
        }
    }
}