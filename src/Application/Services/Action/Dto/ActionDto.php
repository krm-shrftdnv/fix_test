<?php

declare(strict_types=1);

namespace src\Application\Services\Action\Dto;

use src\Application\Services\LoadableFromArray;
use Exception;

class ActionDto implements LoadableFromArray
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public bool $isDefault = false,
    ) {
    }

    /**
     * @throws Exception
     */
    public static function fromArray(array $data): ActionDto
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
            isDefault: $data['is_default'] ?? false,
        );
    }
}
