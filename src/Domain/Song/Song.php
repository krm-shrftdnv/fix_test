<?php

declare(strict_types=1);

namespace App\Domain\Song;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity(table: 'song')]
class Song implements \JsonSerializable
{
    #[Column(type: 'primary')]
    private ?int $id;
    #[Column(type: 'string')]
    private string $name;
    #[Column(type: 'integer')]
    private int $styleId;
    #[Column(type: 'boolean')]
    private bool $isPlaying;
    #[Column(type: 'integer')]
    private int $duration;

    public function __construct(
        string $name,
        int    $styleId,
        int    $duration,
        ?int   $id = null,
        bool   $isPlaying = false,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->styleId = $styleId;
        $this->isPlaying = $isPlaying;
        $this->duration = $duration;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStyleId(): int
    {
        return $this->styleId;
    }

    public function isPlaying(): bool
    {
        return $this->isPlaying;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'style_id' => $this->styleId,
            'is_playing' => $this->isPlaying,
            'duration' => $this->duration,
        ];
    }
}
