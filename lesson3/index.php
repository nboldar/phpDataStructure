<?php
/**
 * Created by PhpStorm.
 * User: nik
 * Date: 24.10.2018
 * Time: 13:18
 */

function isPalindrom($string, $pos = 0)
{
    $string = str_replace(" ", "", $string);
    $string=strtolower($string);
    $stringLength = strlen($string);
    $middle = (int)($stringLength / 2);
    if ($string[$pos] != $string[$stringLength - 1 - $pos]) {
        return false;
    } elseif ($pos < $middle) {
        return isPalindrom($string, ++$pos);
    }
    return true;
}

var_dump(isPalindrom('rs Cahacs'));