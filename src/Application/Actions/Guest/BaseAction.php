<?php

declare(strict_types=1);

namespace src\Application\Actions\Guest;

use src\Application\Actions\Action;
use src\Application\Services\Guest\GuestService;
use src\Domain\Guest\GuestRepository;
use Awurth\SlimValidation\Validator;
use Psr\Log\LoggerInterface;

abstract class BaseAction extends Action
{
    public function __construct(
        protected LoggerInterface $logger,
        protected GuestService    $guestService,
        protected readonly GuestRepository $guestRepository,
        protected Validator $validator,
    ) {
        parent::__construct($logger);
    }
}
