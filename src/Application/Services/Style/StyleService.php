<?php

declare(strict_types=1);

namespace App\Application\Services\Style;

use App\Application\Services\Style\Dto\StyleDto;
use App\Domain\Style\Style;
use App\Domain\Style\StyleRepository;

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
