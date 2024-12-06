<?php

namespace App\Enums;

enum UserRoles: string
{
    case ADMIN = 'admin';
    case TENANT = 'tenant';
    case TENANTADMIN = 'tenant-admin';

    case TENANTUSER = 'tenant-user';

    case CUSTOMER = 'customer';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}
