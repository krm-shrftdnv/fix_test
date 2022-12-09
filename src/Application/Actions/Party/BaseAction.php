<?php

declare(strict_types=1);

namespace src\Application\Actions\Party;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Psr\Log\LoggerInterface;
use src\Application\Actions\Action;
use src\Domain\Action\ActionRepository;
use src\Domain\Dance\DanceRepository;
use src\Domain\Guest\GuestRepository;
use src\Domain\Song\SongRepository;
use src\Domain\Style\StyleRepository;

abstract class BaseAction extends Action
{
    public function __construct(
        protected LoggerInterface      $logger,
        protected ActionRepository     $actionRepository,
        protected GuestRepository      $guestRepository,
        protected StyleRepository      $styleRepository,
        protected SongRepository       $songRepository,
        protected DanceRepository      $danceRepository,
        protected AMQPStreamConnection $amqpStreamConnection,
    ) {
        parent::__construct($logger);
    }
}
