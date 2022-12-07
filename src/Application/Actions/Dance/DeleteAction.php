<?php

declare(strict_types=1);

namespace App\Application\Actions\Dance;

use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;

class DeleteAction extends BaseAction
{
    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id = (int)$this->request->getAttribute('id');
        $dance = $this->danceRepository->findByPK($id);
        if ($dance === null) {
            throw new HttpNotFoundException($this->request);
        }
        $this->danceRepository->delete($dance);
        return $this->response->withStatus(204);
    }
}
