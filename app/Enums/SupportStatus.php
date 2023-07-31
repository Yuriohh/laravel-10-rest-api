<?php

namespace App\Enums;

enum SupportStatus: string
{
    case A = 'Open';
    case C = 'Closed';
    case P = 'Pendind';

    public static function fromValue(string $status): string
    {
        foreach(self::cases() as $case) {
            if($status === $case->name) {
                return $case->value;
            }
        }

        throw new \UnexpectedValueException("$status is not valid");
    }
}