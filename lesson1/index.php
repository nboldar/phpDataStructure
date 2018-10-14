<?php

/**
 * Created by PhpStorm.
 * User: nik
 * Date: 03.10.2018
 * Time: 21:22
 */

function dirInlineName($str)
{
    $arr = explode(DIRECTORY_SEPARATOR, $str);
    $arrRoot = explode(DIRECTORY_SEPARATOR, __DIR__);
    $directoryString = null;
    $directoryPath = __DIR__;
    foreach ($arrRoot as $key => $value) {
        if ($arrRoot[$key] == $arr[$key] or $arr[$key] = 'root') {
            unset($arr[$key]);
        }
    }
    array_unshift($arr, 'root');

    foreach ($arr as $item) {
        if ($item == 'root') {
            $directoryString .= "<a href='./?path=$directoryPath'>{$item}</a>" . "/";
        } else {
            $directoryPath .= DIRECTORY_SEPARATOR . $item;
            $directoryString .= "<a href='./?path=$directoryPath'>{$item}</a>" . "/";
        }
    }
    echo $directoryString . "<br><br><br>";
}

function dirNames($dir)
{
    $ob = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
    foreach ($ob as $name => $object) {
        if ($object->isFile()) {
            echo "<span >this is file  '{$object->getBasename()}'</span><br>";
        } else {
            echo "<span>this is directory</span><a href='./?path=$name'>  '{$object->getBasename()}'</a><br>";
        }

    }
}

if (!isset($_GET['path'])) {
    dirInlineName(__DIR__);
    dirNames(__DIR__);
} else {
    dirInlineName($_GET['path']);
    dirNames($_GET['path']);
}


