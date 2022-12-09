<?php

declare(strict_types=1);

namespace src\Application\Services\Song\Dto;

use src\Application\Services\LoadableFromArray;
use Exception;

class SongDto implements LoadableFromArray
{
    public function __construct(
        public ?int $id = null,
        public ?int $styleId = null,
        public ?string $name = null,
        public bool $isPlaying = false,
        public ?int $duration = null,
    ) {
    }

    public static function fromArray(array $data): SongDto
    {
        return new self(
            id: $data['id'] ?? null,
            styleId: $data['style_id'],
            name: $data['name'],
            isPlaying: $data['is_playing'] ?? false,
            duration: $data['duration'],
        );
    }
}
