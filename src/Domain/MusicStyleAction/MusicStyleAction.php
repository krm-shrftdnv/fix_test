<?php

declare(strict_types=1);

namespace App\Domain\MusicStyleAction;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity(table: 'music_style_action')]
class MusicStyleAction
{
    #[Column(type: 'primary')]
    private int $id;
}