<?php

declare(strict_types=1);

namespace src\Application\Services;

use Exception;

interface LoadableFromArray
{
    public static function fromArray(array $data);
}