<?php

declare(strict_types=1);

namespace Lib\Game\Http\Controllers;

use Lib\Core\Services\TestService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeController
 * @package Lib\Core\Http\Controllers
 */
class HomeController
{
    /**
     * @var TestService
     */
    private $service;

    /**
     * HomeController constructor.
     * @param TestService $service
     */
    public function __construct(TestService $service)
    {
        $this->service = $service;
    }

    public function indexAction(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}