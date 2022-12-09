<?php

declare(strict_types=1);

namespace src\Application\Services\Guest;

use src\Application\Services\Guest\Dto\GuestDto;
use src\Domain\Action\ActionRepository;
use src\Domain\Guest\Guest;
use src\Domain\Guest\GuestRepository;

class GuestService
{
    public function __construct(
        private readonly GuestRepository $guestRepository,
        private readonly ActionRepository $actionRepository,
    ) {
    }

    public function create(GuestDto $dto): Guest
    {
        $actions = $this->actionRepository->findActions($dto->skills);
        $guest = new Guest(
            type: $dto->type,
            name: $dto->name,
            skills: $actions,
        );
        $this->guestRepository->save($guest);
        return $guest;
    }
}
