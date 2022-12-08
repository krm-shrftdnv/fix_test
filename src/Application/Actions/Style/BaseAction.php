<?php

declare(strict_types=1);

namespace src\Application\Actions\Style;

use src\Application\Actions\Action;
use src\Application\Services\Style\StyleService;
use src\Domain\Style\StyleRepository;
use Awurth\SlimValidation\Validator;
use Psr\Log\LoggerInterface;

abstract class BaseAction extends Action
{
    public function __construct(
        protected LoggerInterface          $logger,
        protected StyleService             $styleService,
        protected readonly StyleRepository $styleRepository,
        protected Validator                $validator,
    ) {
        parent::__construct($logger);
    }
}
