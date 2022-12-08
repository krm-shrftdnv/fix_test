<?php

declare(strict_types=1);

namespace src\Application\Services\Action;

use src\Application\Services\Action\Dto\ActionDto;
use src\Domain\Action\Action;
use src\Domain\Action\ActionRepository;

class ActionService
{
    public function __construct(
        private readonly ActionRepository $actionRepository,
    ) {
    }

    public function create(ActionDto $dto): Action
    {
        $action = new Action(
            name: $dto->name,
            isDefault: $dto->isDefault,
        );
        $this->actionRepository->save($action);
        return $action;
    }
}
