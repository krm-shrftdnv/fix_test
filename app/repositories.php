<?php

declare(strict_types=1);

use Cycle\ORM\ORMInterface;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use src\Domain\Action\Action;
use src\Domain\Action\ActionRepository;
use src\Domain\Dance\Dance;
use src\Domain\Dance\DanceRepository;
use src\Domain\Guest\Guest;
use src\Domain\Guest\GuestRepository;
use src\Domain\Song\Song;
use src\Domain\Song\SongRepository;
use src\Domain\Style\Style;
use src\Domain\Style\StyleRepository;
use src\Domain\User\UserRepository;
use src\Infrastructure\Persistence\User\InMemoryUserRepository;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
        ActionRepository::class => fn(ContainerInterface $container) => $container->get(ORMInterface::class)->getRepository(Action::class),
        GuestRepository::class => fn(ContainerInterface $container) => $container->get(ORMInterface::class)->getRepository(Guest::class),
        DanceRepository::class => fn(ContainerInterface $container) => $container->get(ORMInterface::class)->getRepository(Dance::class),
        StyleRepository::class => fn(ContainerInterface $container) => $container->get(ORMInterface::class)->getRepository(Style::class),
        SongRepository::class => fn(ContainerInterface $container) => $container->get(ORMInterface::class)->getRepository(Song::class),
    ]);
};
