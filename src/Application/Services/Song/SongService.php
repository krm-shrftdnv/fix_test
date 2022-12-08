<?php

declare(strict_types=1);

namespace src\Application\Services\Song;

use src\Application\Services\Song\Dto\SongDto;
use src\Domain\Song\Song;
use src\Domain\Song\SongRepository;

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
