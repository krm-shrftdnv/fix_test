<?php

declare(strict_types=1);

namespace App\Application\Services\Action\Dto;

use App\Application\Services\LoadableFromArray;
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
        if (isset($data['name']) && !is_string($data['name'])) {
            throw new Exception('name');
        }
        if (isset($data['is_default']) && !is_bool($data['is_default'])) {
            throw new Exception('is_default');
        }
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
            isDefault: $data['is_default'],
        );
    }
}
