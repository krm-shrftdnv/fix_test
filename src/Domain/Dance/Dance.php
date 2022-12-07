<?php

declare(strict_types=1);

namespace App\Domain\Dance;

use App\Domain\Action\Action;
use App\Domain\DanceAction\DanceAction;
use App\Domain\Style\Style;
use App\Domain\StyleDance\StyleDance;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\ManyToMany;

#[Entity(table: 'dance')]
class Dance implements \JsonSerializable
{
    #[Column(type: 'integer')]
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