<?php

declare(strict_types=1);

namespace src\Application\Actions\Song;

use src\Application\Actions\Action;
use src\Application\Services\Song\SongService;
use src\Domain\Song\SongRepository;
use Awurth\SlimValidation\Validator;
use Psr\Log\LoggerInterface;

abstract class BaseAction extends Action
{
    public function __construct(
        protected LoggerInterface $logger,
        protected SongService    $songService,
        protected readonly SongRepository $songRepository,
        protected Validator $validator,
    ) {
        parent::__construct($logger);
    }
}
