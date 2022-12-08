<?php

declare(strict_types=1);

namespace src\Application\Actions;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpException;
use Throwable;

class ValidationException extends HttpException
{
    private array $errors;
    protected $code = 422;

    public function __construct(
        ServerRequestInterface $request,
        array $errors,
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        $this->errors = $errors;
        $this->message = json_encode($errors, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        parent::__construct($request, $this->message, $code, $previous);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
