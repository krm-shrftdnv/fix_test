<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use PhpAmqpLib\Connection\AMQPStreamConnection;

return static function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        AMQPStreamConnection::class => static fn() => new AMQPStreamConnection(
            'amqp',
            5672,
            'guest',
            'guest',
        ),
    ]);
};
