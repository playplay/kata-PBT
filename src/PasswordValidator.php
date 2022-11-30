<?php

declare(strict_types=1);

namespace PBT;

final class PasswordValidator
{
    public function validate(string $password): bool
    {
        return strlen($password) >= 8;
    }
}
