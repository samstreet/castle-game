<?php

use Doctrine\ORM\Tools\Setup;

require __DIR__.'/vendor/autoload.php';

$app['orm.default_cache'] = 'array';

$newDefaultAnnotationDrivers = [
    __DIR__."/src/Game/Storage/Entity",
];

$app['db.options'] = [
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/database/game.db',
];

$app['orm.proxies_dir'] = __DIR__ . '/src/Game/Storage/Entity/Proxy';
$app['orm.auto_generate_proxies'] = false;
$app['orm.em.options'] = [
    'mappings' => [
        [
            'type' => 'annotation',
            'namespace' => 'App\\Game\\Storage\\Entity',
            'path' => __DIR__ . '/src/Game/Storage/Entity',
            'use_simple_annotation_reader' => false,
        ],
    ]
];

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration([__DIR__."/src"], $isDevMode);

$driverImpl = $config->newDefaultAnnotationDriver($newDefaultAnnotationDrivers);
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache());
$config->setMetadataDriverImpl($driverImpl);
$config->setProxyDir($app['orm.proxies_dir']);
$config->setProxyNamespace('Proxies');

$em = \Doctrine\ORM\EntityManager::create($app['db.options'], $config);

$helpers = new Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em),
));