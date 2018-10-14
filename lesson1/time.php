<?php
/**
 * Created by PhpStorm.
 * User: nik
 * Date: 06.10.2018
 * Time: 0:28
 */
function ordinaryWay()
{
    $arr = [];
    $i = 0;
    $start = microtime(true);
    while ($i < 2000000) {
        array_push($arr, "a" . $i);
        $i++;
    }

    while ($i > 0) {
        array_pop($arr);
        $i--;
    }
    echo 'Время выполнения скрипта: ' . (microtime(true) - $start) . ' сек.';
}

function iteratorWay()
{

    $arrIterator = new SplQueue();
    $i = 0;
    $start = microtime(true);
    while ($i < 2000000) {
        $arrIterator->enqueue("a" . $i);
        $i++;
    }
    while ($i > 0) {
        $arrIterator->dequeue();
        $i--;
    }
    echo 'Время выполнения скрипта: ' . (microtime(true) - $start) . ' сек.';
}

ordinaryWay();
iteratorWay();