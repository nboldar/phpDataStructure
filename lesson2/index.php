<?php
/**
 * Created by PhpStorm.
 * User: nik
 * Date: 08.10.2018
 * Time: 19:31
 */
$arr = [2, 3, 24, 7, 8, 5, 2, 124, 22, 9, 12];
function sortByMerge(array $array)
{
    $arrLen = count($array);
    if ($arrLen <= 1) {
        return $array;
    }
    $mid = (int)($arrLen / 2);
    $left = array_slice($array, 0, $mid);
    $right = array_slice($array, $mid);
    $left = sortByMerge($left);
    $right = sortByMerge($right);

    return merge($left, $right);
}

function merge(array $leftArr, array $rightArr)
{
    $resultArray = [];
    while (count($leftArr) > 0 && count($rightArr) > 0) {
        if ($leftArr[0] < $rightArr[0]) {
            array_push($resultArray, array_shift($leftArr));
        } else {
            array_push($resultArray, array_shift($rightArr));
        }
    }
    array_splice($resultArray, count($resultArray), 0, $leftArr);
    array_splice($resultArray, count($resultArray), 0, $rightArr);
    return $resultArray;
}

var_dump(sortByMerge($arr));
