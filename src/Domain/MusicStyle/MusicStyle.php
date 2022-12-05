<?php

declare(strict_types=1);

namespace App\Domain\MusicStyle;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity(table: 'music_style')]
class MusicStyle implements \JsonSerializable
{
    #[Column(type: 'primary')]
    private ?int $id;
    #[Column(type: 'string')]
    private string $name;

    public function __construct(?int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
