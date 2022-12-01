<?php

declare(strict_types=1);

namespace PBT;

use Eris\TestTrait;
use PHPUnit\Framework\TestCase;

use function Eris\Generator\int;
use function Eris\Generator\map;
use function Eris\Generator\set;
use function Eris\Generator\string;
use function Eris\Generator\suchThat;

function addition(int $a, int $b)
{
    return $a + $b;
}

function removeLastElement(array $list)
{
    array_splice($list, -1, 1);
    return $list;
}

class SampleTest extends TestCase
{
    // ⚠️ If you create another test class you'll need this !
    use TestTrait;

    /**
     * @test
     */
    public function the_identity_element_of_the_addition_is_0()
    {
        $this->forAll(int())
            ->then(fn($number) => $this->assertEquals($number, addition($number, 0)));
    }

    /**
     * @test
     */
    public function addition_is_commutative()
    {
        $this->forAll(int(), int())
            ->then(fn($a, $b) => $this->assertEquals(addition($a, $b), addition($b, $a)));
    }

    /**
     * @test
     */
    public function removing_last_element_from_a_sorted_list_keeps_the_list_sorted()
    {
        $this->forAll(
            map(
                function ($list) {
                    sort($list);
                    return $list;
                },
                set(int())
            )
        )->then(function ($sortedList) {
            $listMinusOneElement = removeLastElement($sortedList);

            $sortedListMinusOneElement = $listMinusOneElement;

            sort($sortedListMinusOneElement);

            $this->assertEquals($sortedListMinusOneElement, $listMinusOneElement);
        });
    }

    /**
     * @test
     */
    public function absolute_value_of_negative_numbers_is_positive(): void
    {
        $this->forAll(int())
            ->when(fn($x) => $x <= 0)
            ->then(fn($x) => $this->assertTrue(abs($x) >= 0));
    }

    /**
     * @test
     */
    public function absolute_value_of_negative_numbers_is_positive_precise_generator(): void
    {
        $this->forAll(
            suchThat(
                fn($x) => $x <= 0,
                int()
            )
        )
            ->when(fn($x) => $x <= 0)
            ->then(fn($x) => $this->assertTrue(abs($x) >= 0));
    }

    /**
     * @test
     * 1 - Uncomment the hook line and watch the generated values
     * 2 - Introduce a bug by uncommenting the code in the reverseString function
     *     You should see that Eris is trying to find a simpler example by removing the last
     *     letter of the string. At some points it will arrive at a 10 chars string which is
     *     valid again and will report the failed value just before.
     */
    public function view_shriking(): void
    {
        function reverseString(string $string)
        {
            // 2- Uncomment the next block of code
//            if(strlen($string) > 10) {
//                return $string . "a";
//            }

            return strrev($string);
        }

        $this->forAll(string())
            // 1- Uncomment the next line to see all generated values
//            ->hook(new ErisHook())
            ->then(function ($string) {
                $this->assertEquals($string, reverseString(reverseString($string)), "$string couldn't be reversed.");
            });
    }
}
