<?php

declare(strict_types=1);

use App\Domain\Action\ActionRepository;
use App\Domain\Dance\DanceRepository;
use App\Domain\Guest\GuestRepository;
use App\Domain\Style\StyleRepository;
use App\Domain\Song\SongRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Action\CycleActionRepository;
use App\Infrastructure\Persistence\Dance\CycleDanceRepository;
use App\Infrastructure\Persistence\Guest\CycleGuestRepository;
use App\Infrastructure\Persistence\Style\CycleStyleRepository;
use App\Infrastructure\Persistence\Song\CycleSongRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use Cycle\ORM\ORMInterface;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
        ActionRepository::class => fn(ContainerInterface $container) => $container->get(ORMInterface::class)->getRepository(CycleActionRepository::class),
        GuestRepository::class => fn(ContainerInterface $container) => $container->get(ORMInterface::class)->getRepository(CycleGuestRepository::class),
        DanceRepository::class => fn(ContainerInterface $container) => $container->get(ORMInterface::class)->getRepository(CycleDanceRepository::class),
        StyleRepository::class => fn(ContainerInterface $container) => $container->get(ORMInterface::class)->getRepository(CycleStyleRepository::class),
        SongRepository::class => fn(ContainerInterface $container) => $container->get(ORMInterface::class)->getRepository(CycleSongRepository::class),
    ]);
};
