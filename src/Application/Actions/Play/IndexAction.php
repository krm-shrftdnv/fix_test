<?php

declare(strict_types=1);

namespace App\Application\Actions\Play;

use Psr\Http\Message\ResponseInterface as Response;

class IndexAction extends BaseAction
{

    protected function action(): Response
    {
        return $this->response;
    }
}
