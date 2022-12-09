<?php

declare(strict_types=1);

namespace src\Application\Actions\Action;

use src\Application\Actions\ValidationException;
use src\Application\Services\Action\Dto\ActionDto;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as V;
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
        $this->validator->validate($data, [
            'name' => V::stringType(),
            'is_default' => V::optional(V::boolType()),
        ]);
        if (!$this->validator->isValid()) {
            throw new ValidationException($this->request, $this->validator->getErrors());
        }
        $dto = ActionDto::fromArray($data);
        try {
            $action = $this->actionService->create($dto);
        } catch (Exception $e) {
            throw new HttpInternalServerErrorException($this->request, $e->getMessage());
        }
        return $this->respondWithData($action)->withStatus(201);
    }
}
