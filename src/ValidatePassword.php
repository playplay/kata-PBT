<?php

declare(strict_types=1);

namespace PBT;

final class ValidatePassword
{
    public function __invoke(string $password): bool
    {
        return strlen($password) > 8 && preg_match('/[A-Z]/', $password) === 1;
    }
}
