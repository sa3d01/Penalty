<?php

namespace App\Http\Enums;

final class UserRole
{
    public const ROLE_SUPER_ADMIN = 1;
    public const ROLE_ADMIN = 2;
    public const ROLE_PLAYER = 3;
    public const ROLE_COACH = 4;
    public const ROLE_ACADEMY = 5;

    public const ROLES = [
        self::ROLE_SUPER_ADMIN => "SUPER_ADMIN",
        self::ROLE_ADMIN => "ADMIN",
        self::ROLE_PLAYER => "PLAYER",
        self::ROLE_COACH => "COACH",
        self::ROLE_ACADEMY => "ACADEMY",
    ];

    public static function of(int $roleId): string
    {
        return self::ROLES[$roleId];
    }
}
