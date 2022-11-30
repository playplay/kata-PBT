<?php

declare(strict_types=1);

namespace PBT;

use Eris\TestTrait;
use PHPUnit\Framework\TestCase;

use function Eris\Generator\int;
use function Eris\Generator\string;
use function Eris\Generator\tuple;


class SampleTest extends TestCase
{
    // ⚠️ If you create another test class you'll need this !
    use TestTrait;

    /**
     * @test
     */
    public function the_identity_element_of_the_addition_is_0() {
        $this->forAll(int())
            ->then(fn ($number) => $this->assertEquals($number, $number + 0));
    }

    /**
     * @test
     */
	public function addition_is_commutative() {

        $this->forAll(tuple(int(), int()))
            ->then(fn ($tuple) => $this->assertEquals($tuple[0] + $tuple[1], $tuple[1] + $tuple[0]));
	}

    /**
    * @test
    */
    public function absolute_value_of_negative_numbers_is_positive(): void {

        $this->forAll(int())
            ->when(fn($x) => $x <= 0)
            ->then(fn($x) => $this->assertTrue(abs($x) >= 0));
    }

    /**
    * @test
    * 1 - Uncomment the var_dump line and watch the generated values
    * 2 - Introduce a bug by uncommenting the code in the reverseString function
    *     You should see that Eris is trying to find a simpler example by removing the last
    *     letter of the string. At some points it will arrive at a 10 chars string which is
    *     valid again and will report the failed value just before.
    */
    public function view_shriking(): void {

        function reverseString(string $string) {

            // 2- Uncomment the next block of code
            if(strlen($string) > 10) {
                return $string . "a";
            }

            return strrev($string);
        }

        $this->forAll(string())
            ->then(function($string) {
                // 1- Uncomment the next line to see all generated values
                var_dump($string);
                $this->assertEquals($string, reverseString(reverseString($string)), "$string couldn't be reversed.");
            });
    }
}
