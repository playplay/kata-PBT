<?php

declare(strict_types=1);

namespace PBT;

use Eris\TestTrait;
use PHPUnit\Framework\TestCase;
use function Eris\Generator\int;
use function Eris\Generator\string;

final class PasswordValidatorTest extends TestCase
{
    // ⚠️ If you create another test class you'll need this !
    use TestTrait;

    public function testPasswordLengthIsMinimum8Characters(): void
    {
        $this->forAll(string())
            ->when(fn($password) => strlen($password) < 8)
            ->then(fn($password) => $this->assertFalse((new PasswordValidator())->validate($password)));
    }
}
