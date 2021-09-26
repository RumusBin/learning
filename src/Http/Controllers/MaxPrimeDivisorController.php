<?php

namespace Rumus\Http\Controllers;

use Exception;
use Rumus\Helpers\MathHelper;

class MaxPrimeDivisorController
{
    public function index()
    {
        include_once __DIR__ . '/../../View/PrimeNumber/index.phtml';
    }

    /**
     * @param array $params
     * @throws Exception
     */
    public function find(array $params): void
    {
        $result = 0;
        if (!empty($params['number']) && is_numeric($params['number'])) {
            $result = MathHelper::findMaxPrimeDivisors($params['number']);

        }
        include_once __DIR__ . '/../../View/PrimeNumber/index.phtml';
    }
}