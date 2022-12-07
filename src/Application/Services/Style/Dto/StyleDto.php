<?php

declare(strict_types=1);

namespace App\Application\Services\Style\Dto;

use App\Application\Services\LoadableFromArray;
use Exception;

class StyleDto implements LoadableFromArray
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
    ) {
    }

    /**
     * @throws Exception
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
        );
    }
}
