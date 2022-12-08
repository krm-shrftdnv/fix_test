<?php

declare(strict_types=1);

namespace src\Application\Actions\Action;

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
        $action = $this->actionRepository->findByPK($id);
        if ($action === null) {
            throw new HttpNotFoundException($this->request);
        }
        $this->actionRepository->delete($action);
        return $this->response->withStatus(204);
    }
}
