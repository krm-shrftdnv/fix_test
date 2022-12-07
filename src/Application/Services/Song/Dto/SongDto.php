<?php

declare(strict_types=1);

namespace App\Application\Services\Song\Dto;

use App\Application\Services\LoadableFromArray;
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

    /**
     * @throws Exception
     */
    public static function fromArray(array $data): SongDto
    {
        return new self(
            id: $data['id'] ?? null,
            styleId: $data['style_id'],
            name: $data['name'],
            isPlaying: $data['is_playing'],
            duration: $data['duration'],
        );
    }
}
