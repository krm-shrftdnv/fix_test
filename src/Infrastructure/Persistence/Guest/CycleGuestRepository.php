<?php

declare(strict_types=1);

namespace src\Infrastructure\Persistence\Guest;

use Cycle\Database\Injection\Parameter;
use src\Domain\Guest\GuestRepository;
use src\Infrastructure\Persistence\Repository;

class CycleGuestRepository extends Repository implements GuestRepository
{
    public function getDancingGuests(): array
    {
        $select = clone $this->select;
        return $select
            ->with(['skills.dances.styles.songs'])
            ->where(['skills.dances.styles.songs.is_playing' => true])
            ->fetchAll();
    }

    /** @param int[] $dancingGuestsIds */
    public function getDrinkingGuests(array $dancingGuestsIds): array
    {
        $select = clone $this->select;
        if (count($dancingGuestsIds) > 0) {
            return $select
                ->where(['id' => ['not in' => new Parameter($dancingGuestsIds)]])
                ->fetchAll();
        }
        return $select->fetchAll();
    }
}
