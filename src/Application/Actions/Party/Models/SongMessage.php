<?php
declare(strict_types=1);

namespace src\Application\Actions\Party\Models;

use JsonSerializable;
use src\Domain\Song\Song;

class SongMessage implements JsonSerializable
{
    public function __construct(
        private readonly Song $song,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->song->getId(),
        ];
    }
}