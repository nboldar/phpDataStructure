<?php



function palindrom($word, $pos = 0) {
    $ln = strlen($word);
    $md = round($ln / 2);
    echo $word[$pos] . ' - ' . $word[$ln - $pos - 1] . ' || ';
    if ($word[$pos] != $word[$ln - $pos - 1]) {
        return FALSE;
    } elseif ($pos < $md) {
        return palindrom($word, ++$pos);
    }
    return TRUE;
}
echo 'redivider<br>';
var_dump(palindrom('redivider'));
echo '<br>deified<br>';
var_dump(palindrom('deified'));
echo '<br>radar<br>';
var_dump(palindrom('radar'));
echo '<br>level<br>';
var_dump(palindrom('level'));
echo '<br>noon<br>';
var_dump(palindrom('noon'));
echo '<br>nosn<br>';
var_dump(palindrom('nosn'));
echo '<br>leavel<br>';
var_dump(palindrom('leavel'));
echo '<br>nikita<br>';
var_dump(palindrom('nikita'));
