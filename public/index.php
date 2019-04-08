<?php

declare(strict_types=1);

$loader = require dirname(__DIR__) . '/vendor/autoload.php';

use App\Game\Providers as GameProviders;
use Lib\Core\Application;
use Lib\Core\Providers as CoreProviders;
use Symfony\Component\HttpFoundation\Request;

$app = new Application();
$app->register(new Silex\Provider\SessionServiceProvider())
    ->register(new GameProviders\DatabaseServiceProvider())
    ->register(new CoreProviders\CoreServiceProvider())
    ->register(new GameProviders\GameServiceProvider());

$app->before(function (Request $request) {
    $request->getSession()->start();
});

$app->run();
