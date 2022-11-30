<?php

declare(strict_types=1);

namespace PBT;

final class PasswordValidator
{
    private static function containsAtLeastOneUpperCaseDigit(string $password): bool
    {
        return preg_match("/[A-Z]/", $password) === 1;
    }

    public function validate(string $password): bool
    {
        return self::isEightOrMoreCharacters($password)
            && self::containsAtLeastOneUpperCaseDigit($password);
    }

    private static function isEightOrMoreCharacters(string $password): bool
    {
        return strlen($password) >= 8;
    }
}
