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

    public function testPasswordLengthIsInvalidWhenUnder8Characters(): void
    {
        $this->minimumEvaluationRatio(0.3)->forAll(string())
            ->when(fn($password) => strlen($password) < 8)
            ->then(fn($password) => $this->assertFalse((new PasswordValidator())->validate($password)));
    }

    public function testPasswordIsInvalidWhenNoUppercase(): void
    {
        $this->minimumEvaluationRatio(0.3)->forAll(string())
            ->when(fn($password) => preg_match('/[A-Z]/', $password) === 0)
            ->then(function($password) {
                $this->assertFalse((new PasswordValidator())->validate($password), "$password should not be valid");
            });
    }

    public function testPasswordIsValidWhenItSatisfiesAllRequirements(): void
    {
        $this->minimumEvaluationRatio(0.3)->forAll(string())
            ->when(fn($password) => strlen($password) >= 8)
            ->then(fn($password) => $this->assertTrue((new PasswordValidator())->validate($password)));
    }
}
