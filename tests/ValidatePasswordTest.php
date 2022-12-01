<?php

declare(strict_types=1);

use Eris\TestTrait;
use PHPUnit\Framework\TestCase;
use function Eris\Generator\string;
use function Eris\Generator\suchThat;

final class ValidatePasswordTest extends TestCase
{
    use TestTrait;

    private \PBT\ValidatePassword $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new \PBT\ValidatePassword();
    }

    public function testPasswordIsInvalidWithLessThan9Characters(): void
    {
        $this->forAll(
            suchThat(
                fn($x) => strlen($x) <= 8,
                string()
            )
        )
        ->then(fn($x) => $this->assertFalse(($this->sut)($x)));
    }

    public function testValidPasswordsHaveMoreThan8Characters(): void
    {
        $this->forAll(
            suchThat(
                fn($x) => ($this->sut)($x),
                string()
            )
        )
            ->then(fn ($x) => $this->assertTrue(strlen($x) > 8));
    }

    public function testPasswordIsInvalidWithoutAtLeastOneUppercaseChar(): void
    {
        $this->forAll(
            suchThat(
                fn($x) => strlen($x) > 8 && preg_match('/[A-Z]/', $x) !== 0,
                string()
            )
        )
            ->then(fn($x) => $this->assertFalse(($this->sut)($x)));
    }

    //public function testValidPasswsordsHaveMoreThan8Characters(): void
    //{
    //    $this->forAll(
    //        suchThat(
    //            fn($x) => ($this->sut)($x),
    //            string()
    //        )
    //    )
    //        ->then(fn ($x) => $this->assertTrue(strlen($x) > 8));
    //}


}

