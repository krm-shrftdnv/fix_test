<?php

declare(strict_types=1);

namespace App\Domain\Guest;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
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

    public function __construct(?int $id, string $type, string $name)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
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
