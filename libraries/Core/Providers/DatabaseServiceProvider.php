<?php

declare(strict_types=1);

namespace Lib\Core\Providers;

use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Lib\Core\Concerns\CanAccessProjectRoot;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Provider\DoctrineServiceProvider;

/**
 * Class DatabaseServiceProvider
 * @package Lib\Core\Providers
 */
class DatabaseServiceProvider implements ServiceProviderInterface
{
    use CanAccessProjectRoot;

    /*
     * @return void
     */
    public function register(Container $app): void
    {
        $app->register(new DoctrineServiceProvider(), [
            'db.options' => [
                'driver' => 'pdo_sqlite',
                'path' => '',
                'dbname' => 'castle',
                'user' => 'test',
                'password' => 'password',
            ],
        ]);

        $app->register(new DoctrineORMServiceProvider(), [
            'db.orm.class_path' => $this->getProjectDir() . '/vendor/doctrine/orm/lib',
            'db.orm.proxies_dir' => $this->getProjectDir() . '/var/cache/doctrine/Proxy',
            'db.orm.proxies_namespace' => 'DoctrineProxy',
            'db.orm.auto_generate_proxies' => true,
            'db.orm.entities' => [
                [
                    'type' => 'annotation',
                    'path' => $this->getProjectDir() . '/src/Storage/Entity',
                    'namespace' => 'Entity',
                ]
            ],
        ]);
    }
}
