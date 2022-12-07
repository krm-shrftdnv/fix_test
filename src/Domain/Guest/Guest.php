<?php

declare(strict_types=1);

namespace App\Domain\Guest;

use App\Domain\Action\Action;
use App\Domain\Skill\Skill;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\ManyToMany;
use JsonSerializable;

#[Entity(table: 'guest')]
class Guest implements JsonSerializable
{
    #[Column(type: 'primary')]
    private ?int $id;
    #[Column(type: 'string')]
    private string $name;
    #[Column(type: 'string')]
    private string $type;

    #[ManyToMany(target: Action::class, throughInnerKey: 'guest_id', throughOuterKey: 'action_id', through: Skill::class)]
    public array $skills = [];

    public function __construct(
        string $type,
        string $name,
        ?int   $id = null,
        array  $skills = [],
    )
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;

        $this->skills = $skills;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
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
            'type' => $this->type,
        ];
    }
}
