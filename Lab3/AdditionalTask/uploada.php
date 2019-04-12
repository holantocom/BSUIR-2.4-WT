<?php

$dir = isset($_POST['dir']) ? $_POST['dir'] : "";

if (is_dir($dir) && ($_FILES["file"]["error"] == 0)){
    
    $save_path = "$dir_to_save/" . $_FILES["file"]["name"];            

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $save_path)){
        echo "Success!<br>";

        if (strpos($_FILES["file"]['type'], 'text') === 0){
            $file = fopen($save_path, "r");
            $contents = fread($file, 30);
            fclose($file);
            echo $contents;
        } elseif (strpos($_FILES["file"]['type'], 'image') === 0){
            copy($save_path, "." . "\\" . pathinfo($save_path)['basename']);      
            echo "<img src=\"" . pathinfo($save_path)['basename'] . "\">";            
        }
    }
} elseif (!is_dir($dir)){
    exit("Неверный путь к директории");    
} else {
    exit("Ошибка при загрузке");
}
