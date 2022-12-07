<?php

declare(strict_types=1);

namespace App\Application\Actions\Dance;

use App\Application\Actions\Action;
use App\Application\Services\Dance\DanceService;
use App\Domain\Dance\DanceRepository;
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
