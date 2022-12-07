<?php

declare(strict_types=1);

namespace App\Application\Services\Dance;

use App\Application\Services\Dance\Dto\DanceDto;
use App\Domain\Dance\Dance;
use App\Domain\Dance\DanceRepository;

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
