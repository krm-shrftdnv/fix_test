<?php

declare(strict_types=1);

namespace src\Application\Actions\Dance;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as V;
use Slim\Exception\HttpInternalServerErrorException;
use src\Application\Actions\ValidationException;
use src\Application\Services\Dance\Dto\DanceDto;

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
            'actions' => V::arrayType()::each(V::intType()),
            'styles' => V::arrayType()::each(V::intType()),
        ]);
        if (!$this->validator->isValid()) {
            throw new ValidationException($this->request, $this->validator->getErrors());
        }
        $dto = DanceDto::fromArray($data);
        try {
            $dance = $this->danceService->create($dto);
        } catch (Exception $e) {
            throw new HttpInternalServerErrorException($this->request, $e->getMessage());
        }
        return $this->respondWithData($dance)->withStatus(201);
    }
}
