<?php


define('HOME', __DIR__ );

spl_autoload_register(function ($className) {
    require_once HOME . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
});

use task1\Category;
use task1\ui\UlWriter;

$categories = Category::getRootCategories();
?>
<html>
    <head>
        <title>Task 1 by Nik</title>
    </head>
    <body>
        <?= UlWriter::printList($categories); ?>
    </body>
</html>
