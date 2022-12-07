<?php

declare(strict_types=1);

namespace App\Application\Actions\Style;

use App\Application\Actions\Action;
use App\Application\Services\Style\StyleService;
use App\Domain\Style\StyleRepository;
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
