<?php

declare(strict_types=1);

namespace src\Application\Actions\Play;

use Psr\Http\Message\ResponseInterface as Response;

class StartAction extends BaseAction
{

    protected function action(): Response
    {
        return $this->response;
    }
}