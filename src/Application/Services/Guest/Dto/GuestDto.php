<?php

declare(strict_types=1);

namespace App\Application\Services\Guest\Dto;

use App\Application\Services\LoadableFromArray;
use Exception;

class GuestDto implements LoadableFromArray
{
    public function __construct(
        public ?int    $id = null,
        public ?string $name = null,
        public ?string $type = null,
    )
    {
    }

    /**
     * @throws Exception
     */
    public static function fromArray(array $data): GuestDto
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
            type: $data['type'],
        );
    }
}
