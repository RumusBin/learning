<?php

namespace Rumus\Http\Controllers;

use JsonException;

class SortController
{
    public const BILLION = 1000_000;
    public const THOUSAND = 1000;
    public const CHECK = 10000;

    protected array $numbersList;

    public function __construct()
    {
        $this->numbersList = range(1, self::CHECK);
        shuffle($this->numbersList);
    }

    /**
     * @throws JsonException
     */
    public function bubbleSort(): void
    {
        $time_start = microtime(true);

        for($i=0; $i < self::CHECK; $i++){
            $count = self::CHECK;
            for($j=$i+1; $j<$count; $j++){
                if($this->numbersList[$i]>$this->numbersList[$j]){
                    $temp = $this->numbersList[$j];
                    $this->numbersList[$j] = $this->numbersList[$i];
                    $this->numbersList[$i] = $temp;
                }
            }
        }
        echo "Execution time: " . number_format((microtime(true) - $time_start), 2) . " seconds";
        echo '<br>';
        echo "<pre>" . json_encode($this->numbersList, JSON_THROW_ON_ERROR) . "</pre>";
    }

    /**
     * @throws JsonException
     */
    public function shakerSort(): void
    {
        $time_start = microtime(true);

        $n = self::CHECK;
        $left = 0;
        $right = $n - 1;
        do {
            for ($i = $left; $i < $right; $i++) {
                if ($this->numbersList[$i] > $this->numbersList[$i + 1]) {
                    [$this->numbersList[$i], $this->numbersList[$i + 1]] = [
                        $this->numbersList[$i + 1],
                        $this->numbersList[$i]
                    ];
                }
            }
            --$right;
            for ($i = $right; $i > $left; $i--) {
                if ($this->numbersList[$i] < $this->numbersList[$i - 1]) {
                    [$this->numbersList[$i], $this->numbersList[$i - 1]] = [$this->numbersList[$i - 1], $this->numbersList[$i]];
                }
            }
            ++$left;
        } while ($left <= $right);

        echo "Execution time: " . number_format((microtime(true) - $time_start), 2) . " seconds";
        echo '<br>';
        echo "<pre>" . json_encode($this->numbersList, JSON_THROW_ON_ERROR) . "</pre>";
    }

    public function quickSort(): void
    {
        $time_start = microtime(true);
        $this->quickSortRealisation($this->numbersList, 1, self::CHECK);
        echo "Execution time: " . number_format((microtime(true) - $time_start), 2) . " seconds";
        echo '<br>';
        echo "<pre>" . json_encode($this->numbersList, JSON_THROW_ON_ERROR) . "</pre>";
    }

    private function quickSortRealisation(&$arr, $low, $high): void
    {
        $i = $low;
        $j = $high;
        $middle = $arr[ ( $low + $high ) / 2 ];   // middle – опорный элемент; в нашей реализации он находится посередине между low и high
        do {
            while($arr[$i] < $middle) ++$i;  // Ищем элементы для правой части
            while($arr[$j] > $middle) --$j;   // Ищем элементы для левой части
                if($i <= $j){
                // Перебрасываем элементы
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;
                // Следующая итерация
                    $i++; $j--;
                }
        }
        while($i < $j);

        if($low < $j){
        // Рекурсивно вызываем сортировку для левой части
            $this->quickSortRealisation($arr, $low, $j);
        }

        if($i < $high){
        // Рекурсивно вызываем сортировку для правой части
            $this->quickSortRealisation($arr, $i, $high);
        }
    }
}