<?php

declare(strict_types=1);

namespace App\Application\Services;

use Exception;

interface LoadableFromArray
{
    /**
     * @throws Exception
     */
    public static function fromArray(array $data);
}