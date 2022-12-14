<?php
declare(strict_types=1);

namespace src\Domain\Action;

use src\Domain\Dance\Dance;
use src\Domain\DanceAction\DanceAction;
use src\Domain\Guest\Guest;
use src\Domain\Skill\Skill;
use src\Infrastructure\Persistence\Action\CycleActionRepository;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\ManyToMany;
use JsonSerializable;

#[Entity(repository: CycleActionRepository::class, table: 'action')]
class Action implements JsonSerializable
{
    #[Column(type: 'primary')]
    private ?int $id;
    #[Column(type: 'string')]
    private string $name;
    #[Column(type: 'boolean', name: 'is_default')]
    private bool $isDefault;
    #[ManyToMany(target: Dance::class, throughInnerKey: 'action_id', throughOuterKey: 'dance_id', through: DanceAction::class)]
    public array $dances = [];
    #[ManyToMany(target: Guest::class, throughInnerKey: 'action_id', throughOuterKey: 'guest_id', through: Skill::class)]
    public array $skilledGuests = [];

    public function __construct(
        string $name,
        bool   $isDefault,
        ?int   $id = null,
        array $dances = [],
        array $skilledGuests = [],
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->isDefault = $isDefault;

        $this->dances = $dances;
        $this->skilledGuests = $skilledGuests;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_default' => $this->isDefault,
        ];
    }
}
