<?php
declare(strict_types=1);

namespace src\Domain\Guest;

enum GuestTypeEnum: string
{
    case BOY = 'boy';
    case GIRL = 'girl';
}