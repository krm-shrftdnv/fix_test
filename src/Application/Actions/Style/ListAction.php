<?php

declare(strict_types=1);

namespace App\Application\Actions\Style;

use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ListAction extends BaseAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        return $this->response;
    }
}
