<?php

$filename = isset($_POST['full_filename']) ? $_POST['full_filename'] : "";
$dir = isset($_POST['new_directory']) ? $_POST['new_directory'] : "";

if (file_exists($filename) && is_dir($dir)){
    if (rename($filename, $dir.pathinfo($filename)['basename']))
    {
        echo "Success!";
    }
} elseif (!file_exists($filename)) {
    exit("Файл по пути не найден");
} else {
    exit("Неверный путь к директории"); 
}

