<?php

declare(strict_types=1);

$loader = require dirname(__DIR__) . '/vendor/autoload.php';

use Doctrine\Common\Annotations\AnnotationRegistry;
use Lib\Core\Application;
use Lib\Core\Providers as CoreProviders;
use App\Game\Providers as GameProviders;

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$app = new Application();
$app->register(new Silex\Provider\SessionServiceProvider())
    ->register(new CoreProviders\CoreServiceProvider())
    ->register(new GameProviders\GameServiceProvider());

$app->run();
