<?php

namespace Rumus\Helpers;

use Exception;

class MathHelper
{
    public static function findDivisors(string $number): array
    {
        $result = [];
        for ($i = 1; $i <= $number; $i++){
            if ($number % $i === 0) {
                $result[] = $i;
            }
        }

        return $result;
    }

    /**
     * @param int $number
     * @return int
     * @throws Exception
     */
    public static function findMaxPrimeDivisors(int $number): int
    {
        $result = 0;
        for ($i = 2; $i <= $number; $i++){
            if ($number % $i === 0 && PrimeNumberHelper::isPrimeNumber($i) && $i > $result) {
                $result = $i;
            }
        }

        return $result;
    }
}