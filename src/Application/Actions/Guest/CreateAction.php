<?php

declare(strict_types=1);

namespace App\Application\Actions\Guest;

use App\Application\Actions\ValidationException;
use App\Application\Services\Guest\Dto\GuestDto;
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
            'type' => V::stringType(),
        ]);
        if (!$this->validator->isValid()) {
            throw new ValidationException($this->request, $this->validator->getErrors());
        }
        try {
            $dto = GuestDto::fromArray($data);
        } catch (Exception $e) {
            throw new HttpBadRequestException($this->request, $e->getMessage());
        }
        try {
            $guest = $this->guestService->create($dto);
        } catch (Exception $e) {
            throw new HttpInternalServerErrorException($this->request, $e->getMessage());
        }
        return $this->respondWithData($guest)->withStatus(201);
    }
}
