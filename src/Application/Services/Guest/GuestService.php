<?php

declare(strict_types=1);

namespace App\Application\Services\Guest;

use App\Application\Services\Guest\Dto\GuestDto;
use App\Domain\Guest\Guest;
use App\Domain\Guest\GuestRepository;

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
