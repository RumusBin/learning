<?php

namespace Rumus\Helpers;

use Exception;

class PrimeNumberHelper
{
    public const MAX_TESTS = 10;
    /**
     * @param int $number
     * @param int|null $maxTests
     * @return bool
     * @throws Exception
     */
    public static function isPrimeNumber(int $number, ?int $maxTests = self::MAX_TESTS): bool
    {
        if (self::isPrimeByFerma($number, $maxTests)) {
            return true;
        }
        return false;
    }

    /**
     * @param $number
     * @param $maxTests
     * @return bool
     * @throws Exception
     */
    private static function isPrimeByFerma($number, $maxTests): bool
    {
        for ($i=1; $i <= $maxTests; $i++){
            $n = random_int(1, $number - 1);
            if (($n**($number - 1)) % $number !== 1) {
                return false;
            }
        }
        // probability of the number being prime is 1/2^max_tests
        return true;
    }
}