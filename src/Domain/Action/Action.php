<?php
declare(strict_types=1);

namespace App\Domain\Action;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use JsonSerializable;

#[Entity(table: 'action')]
class Action implements JsonSerializable
{
    #[Column(type: 'primary')]
    private ?int $id;
    #[Column(type: 'string')]
    private string $name;
    #[Column(type: 'boolean', name: 'is_default')]
    private bool $isDefault;

    public function __construct(
        string $name,
        bool   $isDefault,
        ?int   $id = null,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->isDefault = $isDefault;
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
