<?php

namespace App\Enums;

enum UserRoles: string
{
    case ADMIN = 'admin';
    case TENANT = 'tenant';
    case CUSTOMER = 'customer';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}
