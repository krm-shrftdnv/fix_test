<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use Cycle\ORM\EntityManager;
use Cycle\ORM\ORMInterface;
use Cycle\ORM\Select;

abstract class Repository extends Select\Repository implements RepositoryInterface
{
    private ORMInterface $orm;
    private ?EntityManager $entityManager;

    public function __construct(Select $select, ORMInterface $orm)
    {
        $this->orm = $orm;
        $this->entityManager = new EntityManager($this->orm);
        parent::__construct($select);
    }

    public function save(mixed $object): void
    {
        $this->entityManager->persist($object);
        $this->entityManager->run();
    }

    public function delete(mixed $object): void
    {
        $this->entityManager->delete($object);
        $this->entityManager->run();
    }
}
