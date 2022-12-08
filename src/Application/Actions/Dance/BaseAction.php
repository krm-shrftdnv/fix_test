<?php

declare(strict_types=1);

namespace src\Application\Actions\Dance;

use src\Application\Actions\Action;
use src\Application\Services\Dance\DanceService;
use src\Domain\Dance\DanceRepository;
use Awurth\SlimValidation\Validator;
use Psr\Log\LoggerInterface;

abstract class BaseAction extends Action
{
    public function __construct(
        protected LoggerInterface $logger,
        protected DanceService    $danceService,
        protected readonly DanceRepository $danceRepository,
        protected Validator $validator,
    ) {
        parent::__construct($logger);
    }
}
