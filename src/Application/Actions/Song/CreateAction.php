<?php

declare(strict_types=1);

namespace src\Application\Actions\Song;

use src\Application\Actions\ValidationException;
use src\Application\Services\Song\Dto\SongDto;
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
            'is_playing' => V::optional(V::boolType()),
            'style_id' => V::intType(),
            'duration' => V::intType(),
        ]);
        if (!$this->validator->isValid()) {
            throw new ValidationException($this->request, $this->validator->getErrors());
        }
        try {
            $dto = SongDto::fromArray($data);
        } catch (Exception $e) {
            throw new HttpBadRequestException($this->request, $e->getMessage());
        }
        try {
            $song = $this->songService->create($dto);
        } catch (Exception $e) {
            throw new HttpInternalServerErrorException($this->request, $e->getMessage());
        }
        return $this->respondWithData($song)->withStatus(201);
    }
}
