<?php

declare(strict_types=1);

namespace PBT;

use Eris\TestTrait;
use PHPUnit\Framework\TestCase;
use function Eris\Generator\int;
use function Eris\Generator\string;
use function Eris\Generator\suchThat;

final class ValidatePasswordTest extends TestCase
{
    use TestTrait;

    private ValidatePassword $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new ValidatePassword();
    }

    /**
     * @test
     */
    public function passwordIsInvalidWithLessThan9Characters(): void
    {
        $this->forAll(
            suchThat(
                fn($x) => strlen($x) <= 8,
                string()
            )
        )
        ->then(fn($x) => $this->assertFalse(($this->sut)($x)));
    }
}

