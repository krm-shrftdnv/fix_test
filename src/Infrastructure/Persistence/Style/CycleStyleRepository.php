<?php

declare(strict_types=1);

namespace src\Infrastructure\Persistence\Style;

use Cycle\Database\Injection\Parameter;
use src\Domain\Style\StyleRepository;
use src\Infrastructure\Persistence\Repository;

class CycleStyleRepository extends Repository implements StyleRepository
{
    public function findStyles(array $styleIds): array
    {
        $select = clone $this->select;
        return $select->where(['id' => new Parameter($styleIds)])->fetchAll();
    }
}
