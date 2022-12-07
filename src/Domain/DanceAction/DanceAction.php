<?php

declare(strict_types=1);

namespace App\Domain\DanceAction;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity(table: 'dance_action')]
class DanceAction
{
    #[Column(type: 'primary')]
    private int $id;
}