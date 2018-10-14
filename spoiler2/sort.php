<?
function quickSort(array $mas)
{
    $c = count($mas);
    if ($c <= 1) {
        return $mas;
    }
    $first = $mas[0];
    $left = [];
    $right = [];

    for ($i = 1; $i < $c; $i++) {
        if ($mas[$i] <= $first) {
            $left[] = $mas[$i];
        } else {
            $right[] = $mas[$i];
        }
    }


    $left = quickSort($left);

    $right = quickSort($right);

   var_dump(array_merge($left, [$first], $right));

    return array_merge($left, [$first], $right);
}

var_dump(quickSort([2, 3, 1, 7]));