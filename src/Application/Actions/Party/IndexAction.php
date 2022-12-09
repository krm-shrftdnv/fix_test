<?php

declare(strict_types=1);

namespace src\Application\Actions\Party;

use Psr\Http\Message\ResponseInterface as Response;
use src\Application\Actions\Party\Models\GuestState;
use src\Domain\Guest\Guest;

class IndexAction extends BaseAction
{
    protected function action(): Response
    {
        $dancingGuests = $this->guestRepository->getDancingGuests();
        $drinkingGuests = $this->guestRepository->getDrinkingGuests(
            array_map(fn(Guest $guest) => $guest->getId(), $dancingGuests)
        );
        $defaultAction = $this->actionRepository->findDefault();
        $guests = [];
        foreach ($dancingGuests as $dancingGuest) {
            $actions = $this->actionRepository->findGuestActions($dancingGuest->getId());
            $guests[] = new GuestState(
                guest: $dancingGuest,
                action: $actions[array_rand($actions)],
            );
        }
        foreach ($drinkingGuests as $drinkingGuest) {
            $guests[] = new GuestState(
                guest: $drinkingGuest,
                action: $defaultAction,
            );
        }
        return $this->respondWithData($guests);
    }
}
