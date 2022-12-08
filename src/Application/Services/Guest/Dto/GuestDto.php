<?php

declare(strict_types=1);

namespace src\Application\Services\Guest\Dto;

use src\Application\Services\LoadableFromArray;
use Exception;

class GuestDto implements LoadableFromArray
{
    public function __construct(
        public ?int    $id = null,
        public ?string $name = null,
        public ?string $type = null,
        public array $skills = [],
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
            skills: $data['skills'],
        );
    }
}
