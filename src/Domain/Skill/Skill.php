<?php

declare(strict_types=1);

namespace App\Domain\Skill;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity(table: 'skill')]
class Skill
{
    #[Column(type: 'primary')]
    private int $id;
}
