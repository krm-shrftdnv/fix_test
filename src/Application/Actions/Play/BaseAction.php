<?php

declare(strict_types=1);

namespace src\Application\Actions\Play;

use src\Application\Actions\Action;
use src\Domain\Action\ActionRepository;
use src\Domain\Guest\GuestRepository;
use src\Domain\Style\StyleRepository;
use src\Domain\Song\SongRepository;
use Psr\Log\LoggerInterface;

abstract class BaseAction extends Action
{
    public function __construct(
        protected LoggerInterface  $logger,
        protected ActionRepository $actionRepository,
        protected GuestRepository  $guestRepository,
        protected StyleRepository  $styleRepository,
        protected SongRepository   $songRepository,
    ) {
        parent::__construct($logger);
    }
}
