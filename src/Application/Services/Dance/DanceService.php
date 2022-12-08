<?php

declare(strict_types=1);

namespace src\Application\Services\Dance;

use src\Application\Services\Dance\Dto\DanceDto;
use src\Domain\Dance\Dance;
use src\Domain\Dance\DanceRepository;

class DanceService
{
    public function __construct(
        private readonly DanceRepository $danceRepository,
    ) {
    }

    public function create(DanceDto $dto): Dance
    {
        $dance = new Dance(
            name: $dto->name,
        );
        $this->danceRepository->save($dance);
        return $dance;
    }
}
