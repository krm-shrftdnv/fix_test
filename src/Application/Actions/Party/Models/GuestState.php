<?php
declare(strict_types=1);

namespace src\Application\Actions\Party\Models;

use JsonSerializable;
use src\Domain\Action\Action;
use src\Domain\Guest\Guest;

class GuestState implements JsonSerializable
{
    public function __construct(
        private readonly Guest $guest,
        private readonly Action $action,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'guest' => [
                'id' => $this->guest->getId(),
                'name' => $this->guest->getName(),
                'type' => $this->guest->getType(),
                'action' => $this->action,
            ],
        ];
    }
}