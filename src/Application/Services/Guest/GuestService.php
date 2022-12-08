<?php

declare(strict_types=1);

namespace src\Application\Services\Guest;

use src\Application\Services\Guest\Dto\GuestDto;
use src\Domain\Guest\Guest;
use src\Domain\Guest\GuestRepository;

class GuestService
{
    public function __construct(
        private readonly GuestRepository $guestRepository,
    ) {
    }

    public function create(GuestDto $dto): Guest
    {
        $guest = new Guest(
            type: $dto->type,
            name: $dto->name,
        );
        $this->guestRepository->save($guest);
        return $guest;
    }
}
