<?php

declare(strict_types=1);

namespace App\Application\Services\Dance\Dto;

use App\Application\Services\LoadableFromArray;
use Exception;

class DanceDto implements LoadableFromArray
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
    ) {
    }

    /**
     * @throws Exception
     */
    public static function fromArray(array $data): DanceDto
    {
        if (isset($data['name']) && !is_string($data['name'])) {
            throw new Exception('name');
        }
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
        );
    }
}
