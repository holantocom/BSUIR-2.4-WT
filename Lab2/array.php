<?php
    if(isset($_POST['arr1']) and isset($_POST['arr2'])){
        $arr1 = str_replace(" ", "", $_POST['arr1']);
        $arr2 = str_replace(" ", "", $_POST['arr2']);
        $arr1 = explode(",", $arr1);
        $arr2 = explode(",", $arr2);
        
        foreach($arr2 as $element)
            $arr1[] = $element;
            
        print_r($arr1);    
        foreach($arr1 as $el)
            if((intval($el) % 2 == 0))
                echo "$el ";
          
        
    } else {
        echo 'Не все поля заполнены';
    }
        
    
?>    
<!DOCTYPE HTML>
<html>
<head>
    <title>Клевый сайт для проверки массивов</title>
</head>          
<body>

<form method="post">
Массив 1: <input type="text" name="arr1" required><br>
Массив 2: <input type="text" name="arr2" required><br>
<input type="submit">
</form>

</body>
</html>