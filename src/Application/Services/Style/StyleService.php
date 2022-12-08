<?php

declare(strict_types=1);

namespace src\Application\Services\Style;

use src\Application\Services\Style\Dto\StyleDto;
use src\Domain\Style\Style;
use src\Domain\Style\StyleRepository;

class StyleService
{
    public function __construct(
        private readonly StyleRepository $actionRepository,
    ) {
    }

    public function create(StyleDto $dto): Style
    {
        $action = new Style(
            name: $dto->name,
        );
        $this->actionRepository->save($action);
        return $action;
    }
}
