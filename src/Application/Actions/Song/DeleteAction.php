<?php

declare(strict_types=1);

namespace App\Application\Actions\Guest;

use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class DeleteAction extends \App\Application\Actions\Play\BaseAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        // TODO: Implement action() method.
    }
}
