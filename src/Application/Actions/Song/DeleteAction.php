<?php

declare(strict_types=1);

namespace src\Application\Actions\Song;

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
        $song = $this->songRepository->findByPK($id);
        if ($song === null) {
            throw new HttpNotFoundException($this->request);
        }
        $this->songRepository->delete($song);
        return $this->response->withStatus(204);
    }
}
