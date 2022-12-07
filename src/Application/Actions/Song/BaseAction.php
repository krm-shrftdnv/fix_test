<?php

declare(strict_types=1);

namespace App\Application\Actions\Song;

use App\Application\Actions\Action;
use App\Application\Services\Song\SongService;
use App\Domain\Song\SongRepository;
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
