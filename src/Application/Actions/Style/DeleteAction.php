<?php

declare(strict_types=1);

namespace src\Application\Actions\Style;

use src\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class DeleteAction extends \src\Application\Actions\Play\BaseAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        return $this->response;
    }
}
