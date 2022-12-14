<?php

declare(strict_types=1);

namespace src\Application\Services\Dance\Dto;

use src\Application\Services\LoadableFromArray;
use Exception;

class DanceDto implements LoadableFromArray
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public array $actionIds = [],
        public array $styleIds = [],
    ) {
    }

    public static function fromArray(array $data): DanceDto
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
            actionIds: $data['actions'],
            styleIds: $data['styles'],
        );
    }
}
