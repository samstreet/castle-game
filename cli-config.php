<?php

require __DIR__.'/vendor/autoload.php';

$app['orm.default_cache'] = 'array';

$newDefaultAnnotationDrivers = array(
    __DIR__."/src/Game/Storage",
);

$app['db.options'] = [
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/database/game.db',
];

$app['orm.proxies_dir'] = __DIR__ . '/src/Game/Storage/Entity/Proxy';
$app['orm.auto_generate_proxies'] = $app['debug'];
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

$config = new \Doctrine\ORM\Configuration();

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