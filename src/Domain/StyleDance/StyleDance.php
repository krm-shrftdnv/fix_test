<?php

declare(strict_types=1);

namespace src\Domain\StyleDance;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity(table: 'style_dance')]
class StyleDance
{
    #[Column(type: 'primary')]
    private ?int $id;
}