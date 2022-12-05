<?php

declare(strict_types=1);

namespace App\Application\Actions\Action;

use App\Application\Actions\Action;
use App\Application\Services\Action\ActionService;
use App\Domain\Action\ActionRepository;
use Psr\Log\LoggerInterface;

abstract class BaseAction extends Action
{
    public function __construct(
        protected LoggerInterface $logger,
        protected ActionRepository $actionRepository,
        protected ActionService $actionService,
    )
    {
        parent::__construct($logger);
    }
}
