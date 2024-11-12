<?php

namespace App\Enums;

enum UserTypes: string
{
    case CUSTOMER = 'customer';
    case ADMIN = 'admin';
    case TENANT = 'tenant';
}
