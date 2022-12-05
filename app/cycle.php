<?php

declare(strict_types=1);

use Cycle\Annotated\Embeddings;
use Cycle\Annotated\Entities;
use Cycle\Annotated\MergeColumns;
use Cycle\Annotated\MergeIndexes;
use Cycle\Annotated\TableInheritance;
use Cycle\Database\Config\DatabaseConfig;
use Cycle\Database\Config\Postgres\DsnConnectionConfig;
use Cycle\Database\Config\PostgresDriverConfig;
use Cycle\Database\DatabaseInterface;
use Cycle\Database\DatabaseManager;
use Cycle\ORM\ORM;
use Cycle\ORM\ORMInterface;
use Cycle\ORM\Schema;
use Cycle\Schema\Compiler;
use Cycle\Schema\Generator\GenerateModifiers;
use Cycle\Schema\Generator\GenerateRelations;
use Cycle\Schema\Generator\GenerateTypecast;
use Cycle\Schema\Generator\RenderModifiers;
use Cycle\Schema\Generator\RenderRelations;
use Cycle\Schema\Generator\RenderTables;
use Cycle\Schema\Generator\ResetTables;
use Cycle\Schema\Generator\ValidateEntities;
use Cycle\Schema\Registry;
use DI\ContainerBuilder;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Spiral\Core\Container;
use Spiral\Tokenizer\ClassLocator;
use Symfony\Component\Finder\Finder;

return static function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        PostgresDriverConfig::class => static fn(ContainerInterface $container) => new PostgresDriverConfig(
            connection: $container->get(DsnConnectionConfig::class),
            queryCache: false
        ),
        'DatabaseConfig' => static fn(ContainerInterface $container) => [
            'default' => 'default',
            'aliases' => [],
            'databases' => [
                'default' => ['connection' => 'pgsql']
            ],
            'connections' => [
                'pgsql' => $container->get(PostgresDriverConfig::class)
            ]
        ],
        DatabaseManager::class => function (ContainerInterface $container) {
            $dbConfig = $container->get('DatabaseConfig');
            $databaseManager = new DatabaseManager(new DatabaseConfig($dbConfig));
            $databaseManager->setLogger($container->get(LoggerInterface::class));
            return $databaseManager;
        },
        DatabaseInterface::class => function (ContainerInterface $container) {
            return $container->get(DatabaseManager::class)->database('default');
        },
        ORMInterface::class => function (ContainerInterface $container) {
            $entitiesPath = dirname(__DIR__) . "/App/Domain";
            $finder = (new Finder())->files()->in([$entitiesPath]); // __DIR__ here is folder with entities
            $classLocator = new ClassLocator($finder);
            $cache = $container->get(CacheItemPoolInterface::class);
            $schemaItem = $cache->getItem(md5(Schema::class));
            if ($schemaItem->isHit()) {
                $schema = $schemaItem->get();
            } else {
                $schema = new Schema((new Compiler())->compile(new Registry($container->get(DatabaseManager::class)), [
                    new ResetTables(),
                    new Embeddings($classLocator),
                    new Entities($classLocator),
                    new TableInheritance(),
                    new MergeColumns(),
                    new GenerateRelations(),
                    new GenerateModifiers(),
                    new ValidateEntities(),
                    new RenderTables(),
                    new RenderRelations(),
                    new RenderModifiers(),
                    new MergeIndexes(),
                    new GenerateTypecast(),
                ]));
                $schemaItem->set($schema);
                $schemaItem->expiresAt((new DateTimeImmutable())->add(new DateInterval("PT1M")));
                $cache->save($schemaItem);
            }
            return new ORM(
                factory: new Cycle\ORM\Factory($container->get(DatabaseManager::class)),
                schema: $schema,
                commandGenerator: new Cycle\ORM\Entity\Behavior\EventDrivenCommandGenerator($schema, new Container())
            );
        }
    ]);
};
