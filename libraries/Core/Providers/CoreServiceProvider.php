<?php

declare(strict_types=1);

namespace Lib\Core\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CoreServiceProvider
 * @package Lib\Core\Providers
 */
class CoreServiceProvider extends CoreProvider implements ServiceProviderInterface
{
    /**
     * @var array
     */
    protected $provides = [
        RouteServiceProvider::class
    ];

    /**
     * @param Container $app
     */
    public function register(Container $app): void
    {
        $this->registerProviders($app);
        $this->registerMiddleware($app);

//        $app->error(function (\Exception $e) use ($app) {
//            if ($e instanceof NotFoundHttpException) {
//                return $app->json(array('error' => 'Page Not Found'), Response::HTTP_NOT_FOUND);
//            }
//
//            $code = ($e instanceof HttpException) ? $e->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
//            return $app->json(array('error' => $e->getMessage()), $code);
//        });
    }

    /**
     * @inheritDoc
     */
    public function registerMiddleware(Container $app): void
    {
        return;
    }
}
