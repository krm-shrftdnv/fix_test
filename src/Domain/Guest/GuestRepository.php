<?php

declare(strict_types=1);

namespace src\Domain\Guest;

use src\Infrastructure\Persistence\RepositoryInterface;

interface GuestRepository extends RepositoryInterface
{
    public function getDancingGuests(): array;
    public function getDrinkingGuests(array $dancingGuestsIds): array;
}
