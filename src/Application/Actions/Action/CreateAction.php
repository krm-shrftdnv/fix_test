<?php

declare(strict_types=1);

namespace App\Application\Actions\Action;

use App\Application\Services\Action\Dto\ActionDto;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;

class CreateAction extends BaseAction
{
    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        try {
            $dto = ActionDto::fromArray($data);
        } catch (Exception $e) {
            throw new HttpBadRequestException($this->request, $e->getMessage());
        }
        try {
            $action = $this->actionService->create($dto);
        } catch (Exception $e) {
            throw new HttpInternalServerErrorException($this->request, $e->getMessage());
        }
        return $this->respondWithData($action)->withStatus(201);
    }
}
