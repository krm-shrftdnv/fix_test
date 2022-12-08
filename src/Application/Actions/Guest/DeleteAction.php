<?php

declare(strict_types=1);

namespace src\Application\Actions\Guest;

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
        $guest = $this->guestRepository->findByPK($id);
        if ($guest === null) {
            throw new HttpNotFoundException($this->request);
        }
        $this->guestRepository->delete($guest);
        return $this->response->withStatus(204);
    }
}
