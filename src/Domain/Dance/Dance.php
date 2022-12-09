<?php

declare(strict_types=1);

namespace src\Domain\Dance;

use src\Domain\Action\Action;
use src\Domain\DanceAction\DanceAction;
use src\Domain\Style\Style;
use src\Domain\StyleDance\StyleDance;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\ManyToMany;
use src\Infrastructure\Persistence\Dance\CycleDanceRepository;

#[Entity(repository: CycleDanceRepository::class, table: 'dance')]
class Dance implements \JsonSerializable
{
    #[Column(type: 'primary')]
    private ?int $id;
    #[Column(type: 'string')]
    private string $name;
    #[ManyToMany(target: Action::class, throughInnerKey: 'dance_id', throughOuterKey: 'action_id', through: DanceAction::class)]
    public array $actions = [];
    #[ManyToMany(target: Style::class, throughInnerKey: 'dance_id', throughOuterKey: 'style_id', through: StyleDance::class)]
    public array $styles = [];

    public function __construct(
        string $name,
        ?int $id = null,
        array $actions = [],
        array $styles = [],
    )
    {
        $this->id = $id;
        $this->name = $name;

        $this->actions = $actions;
        $this->styles = $styles;
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