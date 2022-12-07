<?php

declare(strict_types=1);

namespace App\Application\Services\Song;

use App\Application\Services\Song\Dto\SongDto;
use App\Domain\Song\Song;
use App\Domain\Song\SongRepository;

class SongService
{
    public function __construct(
        private readonly SongRepository $songRepository,
    )
    {
    }

    public function create(SongDto $dto): Song
    {
        $song = new Song(
            name: $dto->name,
            styleId: $dto->styleId,
            duration: $dto->duration,
            isPlaying: $dto->isPlaying,
        );
        $this->songRepository->save($song);
        return $song;
    }
}
