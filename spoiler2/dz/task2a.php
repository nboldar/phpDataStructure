<?php
$arr = [];

/*
 * на моей машине со значения ~5000 начинает выигрывать итератор, но он также память жрёт.
 * С 10000 однозначно выигрывает итератор в 100% случаев
 */
const ARRAY_LENGTH = 50000;

// заполнение тестовыми строками
for ($j = 0; $j < ARRAY_LENGTH; $j++) {
    $arr[$j] = "test $j";
}

$start = microtime(true);


foreach ($arr as $key => $item) {
    $temp = $item;
    //echo $key . "=" . $item . "\n";
}

echo '<br><br>Время выполнения форича: ' . round(microtime(true) - $start, 4) . ' сек.<br><br>';
echo memory_get_usage() . ' bytes Использовал форич' . PHP_EOL . "<br><br><hr>";