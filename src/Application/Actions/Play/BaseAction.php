<?php

declare(strict_types=1);

namespace App\Application\Actions\Play;

use App\Application\Actions\Action;
use App\Domain\Action\ActionRepository;
use App\Domain\Guest\GuestRepository;
use App\Domain\MusicStyle\MusicStyleRepository;
use App\Domain\Song\SongRepository;
use Psr\Log\LoggerInterface;

abstract class BaseAction extends Action
{
    public function __construct(
        protected LoggerInterface $logger,
        protected ActionRepository $actionRepository,
        protected GuestRepository $guestRepository,
        protected MusicStyleRepository $musicStyleRepository,
        protected SongRepository $songRepository,
    ) {
        parent::__construct($logger);
    }
}