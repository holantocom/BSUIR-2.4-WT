<!DOCTYPE html>
<html>
<head>
    <style>
    .green{
        color: green;
    }
    .blue {
        color: blue;
    }
    .red {
        color: red;
    }
    </style>
</head>
<body>
    <form method="post" >  
        <textarea name="comment" rows="5" cols="40"></textarea><br>
        <input type="submit" name="submit" value="Submit">  
</form>    
</body>
</html>
<?php
if(isset($_POST['comment'])){
    $text = " ".$_POST['comment']." ";
    echo $text."<br>";
    $text = preg_replace('/([^>]?[A-ZА-ЯЁ][a-zа-яё]*)/u', " <span class=\"green\">$0</span> ", $text);
    $text = preg_replace('/([0-9]+[.,][0-9]{1})\d*/u', " <span class=\"red\">$1</span> ", $text);
    $text = preg_replace('/([^A-ZА-ЯЁa-zа-яё.][0-9]+[ ])/u', " <span class=\"blue\">$0</span> ", $text);
   echo $text;
}
?>