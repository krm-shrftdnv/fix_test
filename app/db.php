<?php

declare(strict_types=1);

use Cycle\Database\Config\Postgres\DsnConnectionConfig;
use DI\ContainerBuilder;

return static function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        DsnConnectionConfig::class => static fn() => new DsnConnectionConfig(
            dsn: 'pgsql:host=database;port=5432;dbname=fix_test',
            user: getenv('POSTGRES_USER'),
            password: getenv('POSTGRES_PASSWORD'),
        ),
    ]);
};
