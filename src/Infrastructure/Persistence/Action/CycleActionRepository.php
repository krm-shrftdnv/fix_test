<?php

declare(strict_types=1);

namespace src\Infrastructure\Persistence\Action;

use src\Domain\Action\Action;
use src\Domain\Action\ActionRepository;
use src\Infrastructure\Persistence\Repository;

class CycleActionRepository extends Repository implements ActionRepository
{

    public function findDefault(): Action
    {
        $select = clone $this->select;
        return $select
            ->where(['is_default' => true])
            ->fetchOne();
    }

    public function findGuestActions(int $guestId): array
    {
        $select = clone $this->select;
        return $select
            ->with(['skilledGuests', 'dances.styles.songs'])
            ->where([
                'dances.styles.songs.is_playing' => true,
                'skilledGuests.id' => $guestId,
            ])
            ->fetchAll();
    }
}