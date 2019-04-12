<?php

function scaning($dir)
{
    $count = 0;
    $ffs = scandir($dir);

    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);

    if (count($ffs) < 1)
        return;

    echo '<table>';
    foreach($ffs as $ff){
        echo '<tr><td>'.$ff;
        if(is_dir($dir.'/'.$ff)) $count += scaning($dir.'/'.$ff); else $count += filesize($dir.'/'.$ff);
        echo '</td></tr>';
    }
    echo '</table>';
    return $count;
}


if(isset($_POST['dir'])){
    $count = scaning($_POST['dir']);
    echo "Размер файлов: $count";
}

?>
<form  method="POST">
    <input type="text" name="dir" placeholder="Имя директории"/><br><br>
    <input type="submit" value="Сканировать">
</form>