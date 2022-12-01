<?php

declare(strict_types=1);

namespace PBT;

final class ValidatePassword
{
    public function __invoke(string $password): bool
    {
        return true;
    }
}
