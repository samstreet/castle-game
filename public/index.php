<?php

declare(strict_types=1);

require dirname(__DIR__).'/vendor/autoload.php';

use Lib\Core\Application;
use Lib\Core\Providers as CoreProviders;
use Lib\Game\Providers as GameProviders;

$app = new Application();
$app->register(new CoreProviders\CoreServiceProvider())
    ->register(new GameProviders\GameRouteServiceProvider());

$app->run();
