<?php

declare(strict_types=1);

namespace App\Application\Actions\Guest;

use App\Application\Actions\Action;
use App\Application\Services\Guest\GuestService;
use App\Domain\Guest\GuestRepository;
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
