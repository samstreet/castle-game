<?php

declare(strict_types=1);

namespace App\Game\Providers;

use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Lib\Core\Concerns\CanAccessProjectRoot;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Provider\DoctrineServiceProvider;

/**
 * @package App\Game\Providers
 * @author Sam Street <sam.street@tutora.co.uk>
 */
class DatabaseServiceProvider implements ServiceProviderInterface
{
    use CanAccessProjectRoot;

    /**
     * @inheritDoc
     */
    public function register(Container $app): void
    {
        $app->register(new DoctrineServiceProvider(), [
            'db.options' => [
                'driver' => 'pdo_sqlite',
                'path' => $this->getProjectDir() . '/database/game.db',
            ]
        ]);

        $app->register(new DoctrineOrmServiceProvider, [
            'orm.proxies_dir' => $this->getProjectDir() . '/src/Game/Storage/Entity/Proxy',
            'orm.auto_generate_proxies' => $app['debug'],
            'orm.em.options' => [
                'mappings' => [
                    [
                        'type' => 'annotation',
                        'namespace' => 'App\\Game\\Storage\\Entity',
                        'path' => $this->getProjectDir() . '/src/Game/Storage/Entity',
                        'use_simple_annotation_reader' => false,
                    ],
                ],
            ]
        ]);
    }
}