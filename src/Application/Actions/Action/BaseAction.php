<?php

declare(strict_types=1);

namespace src\Application\Actions\Action;

use src\Application\Actions\Action;
use src\Application\Services\Action\ActionService;
use src\Domain\Action\ActionRepository;
use Awurth\SlimValidation\Validator;
use Psr\Log\LoggerInterface;

abstract class BaseAction extends Action
{
    public function __construct(
        protected LoggerInterface $logger,
        protected ActionRepository $actionRepository,
        protected ActionService $actionService,
        protected Validator $validator,
    ) {
        parent::__construct($logger);
    }
}
