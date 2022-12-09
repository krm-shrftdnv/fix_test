<?php

declare(strict_types=1);

namespace src\Application\Actions\Guest;

use src\Application\Actions\ValidationException;
use src\Application\Services\Guest\Dto\GuestDto;
use src\Domain\Guest\GuestTypeEnum;
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
            'type' => V::in([GuestTypeEnum::BOY->value, GuestTypeEnum::GIRL->value]),
            'skills' => V::arrayType()::each(V::intType()),
        ]);
        if (!$this->validator->isValid()) {
            throw new ValidationException($this->request, $this->validator->getErrors());
        }
        $dto = GuestDto::fromArray($data);
        try {
            $guest = $this->guestService->create($dto);
        } catch (Exception $e) {
            throw new HttpInternalServerErrorException($this->request, $e->getMessage());
        }
        return $this->respondWithData($guest)->withStatus(201);
    }
}
