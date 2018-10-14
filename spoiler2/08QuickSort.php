<?php

$array = [1, 5, 6, 8, 2, 2, 0, 3, 4, 9, 7];


function quickSort(&$arr, $low, $high) {
    $i = $low;
    $j = $high;
    $middle = $arr[ ( $low + $high ) / 2 ];   // middle – опорный элемент; в нашей реализации он находится посередине между low и high
    do {
        while($arr[$i] < $middle) ++$i;     // Ищем элементы для правой части
        while($arr[$j] > $middle) --$j;     // Ищем элементы для левой части
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
        quickSort($arr, $low, $j);
    }

    if($i < $high){
// Рекурсивно вызываем сортировку для правой части
        quickSort($arr, $i, $high);
    }

}


quickSort( $array,0, count($array));

var_dump( $array );


