<?php

declare(strict_types=1);

namespace src\Domain\Action;

use src\Infrastructure\Persistence\RepositoryInterface;

interface ActionRepository extends RepositoryInterface
{
    public function findDefault(): Action;
    public function findGuestActions(int $guestId): array;
}
