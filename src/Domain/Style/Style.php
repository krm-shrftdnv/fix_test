<?php

declare(strict_types=1);

namespace src\Domain\Style;

use Cycle\Annotated\Annotation\Relation\HasMany;
use src\Domain\Dance\Dance;
use src\Domain\Song\Song;
use src\Domain\StyleDance\StyleDance;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\ManyToMany;
use src\Infrastructure\Persistence\Style\CycleStyleRepository;

#[Entity(repository: CycleStyleRepository::class, table: 'style')]
class Style implements \JsonSerializable
{
    #[Column(type: 'primary')]
    private ?int $id;
    #[Column(type: 'string')]
    private string $name;
    #[ManyToMany(target: Dance::class, throughInnerKey: 'style_id', throughOuterKey: 'dance_id', through: StyleDance::class)]
    public array $dances = [];
    #[HasMany(target: Song::class, innerKey: 'id', outerKey: 'style_id')]
    public array $songs = [];

    public function __construct(
        string $name,
        ?int $id = null,
        array $dances = [],
    )
    {
        $this->id = $id;
        $this->name = $name;

        $this->dances = $dances;
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
