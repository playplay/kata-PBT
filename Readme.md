# PBT

In this session, we're going to discover Property-Based Testing.

## Instructions

Let's redo some kata we've already tried and see how PBT can change the way we approach the problem.

We're going to use [Eris](https://eris.readthedocs.io/en/latest/index.html) as our PBT tool. It will generate multiple random values to try falsifying our properties. In case of a property being falsified it will shrink the values to try to get a simpler example.


## Try writing tests for some properties we've discussed using Eris

Here are some ideas but feel free to try your own ones :

- Repeating a string twice give a string twice as long as the original one
- Reversing a string twice gives the same string
- A sorted list is the same length of the original list
- Monday + 7 days is a Monday

Try seeing the generated values (with a debugger or `var_dump`) and create a bug just to see the shrinking in action. You can play with the `view_shriking` test.

## Password validation

https://www.codurance.com/katalyst/password-validation

## FizzBuzz

https://github.com/ardalis/kata-catalog/blob/main/katas/FizzBuzz.md

## Got more time ?

Imagine some examples with what you know with the business rules your work on every day.

## Resources

If you want to learn more about Property-Based Testing you can find resources [here](./RESOURCES.md).

## Getting started

Run `composer install` to get dependencies.

Alternatively, you can install dependencies using docker with `docker-compose run --rm php composer install`.

## Run tests

You can run tests with PhpUnit using `./vendor/bin/phpunit`.

If you prefer using docker you can run tests with `docker-compose run --rm php ./vendor/bin/phpunit`.
