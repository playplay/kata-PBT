<?php

declare(strict_types=1);

namespace PBT;

use Eris\Listener;
use Exception;

final class ErisHook implements Listener
{

    public function startPropertyVerification()
    {
    }

    public function endPropertyVerification($ordinaryEvaluations, $iterations, Exception $exception = null)
    {
    }

    public function newGeneration(array $generation, $iteration)
    {
        echo "[$iteration]Generation : " . var_export($generation);
    }

    public function failure(array $generation, Exception $exception)
    {
        echo "Failure : " . var_export($generation);

    }

    public function shrinking(array $generation)
    {
        echo "Shriking : " . var_export($generation);

    }
}