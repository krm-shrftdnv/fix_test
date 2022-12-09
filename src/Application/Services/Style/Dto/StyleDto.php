<?php

declare(strict_types=1);

namespace src\Application\Services\Style\Dto;

use src\Application\Services\LoadableFromArray;
use Exception;

class StyleDto implements LoadableFromArray
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
        );
    }
}
