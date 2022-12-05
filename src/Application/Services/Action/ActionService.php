<?php

declare(strict_types=1);

namespace App\Application\Services\Action;

use App\Application\Services\Action\Dto\ActionDto;
use App\Domain\Action\Action;
use App\Domain\Action\ActionRepository;

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
