<?php

declare(strict_types=1);

namespace src\Application\Services\Dance;

use src\Application\Services\Dance\Dto\DanceDto;
use src\Domain\Action\ActionRepository;
use src\Domain\Dance\Dance;
use src\Domain\Dance\DanceRepository;
use src\Domain\Style\StyleRepository;

class DanceService
{
    public function __construct(
        private readonly DanceRepository  $danceRepository,
        private readonly ActionRepository $actionRepository,
        private readonly StyleRepository  $styleRepository,
    ) {
    }

    public function create(DanceDto $dto): Dance
    {
        $actions = $this->actionRepository->findActions($dto->actionIds);
        $styles = $this->styleRepository->findStyles($dto->styleIds);
        $dance = new Dance(
            name: $dto->name,
            actions: $actions,
            styles: $styles,
        );
        $this->danceRepository->save($dance);
        return $dance;
    }
}
