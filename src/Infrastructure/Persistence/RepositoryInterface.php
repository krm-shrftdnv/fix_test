<?php

declare(strict_types=1);

namespace src\Infrastructure\Persistence;

interface RepositoryInterface
{
    public function findByPK(mixed $id): ?object;

    public function findOne(array $scope = []): ?object;

    public function findAll(array $scope = [], array $orderBy = []): iterable;

    public function save(mixed $object): void;

    public function delete(mixed $object): void;
}
