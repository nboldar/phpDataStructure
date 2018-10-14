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



$iter = new ArrayIterator($arr);

while($iter->valid()) {
    $temp = $iter->current();
    $iter->next();
}

echo '<br><br>Время выполнения итератора: ' . round(microtime(true) - $start, 4) . ' сек.<br><br>';
echo memory_get_usage() . ' bytes Использовал итератор' . PHP_EOL . "<br><br><hr>";