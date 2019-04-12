<!DOCTYPE HTML>
<html>
<head>
    <title>Клевый сайт для вытягивания записей</title>
</head>          
<body>

<form method="post">
Введите количество записей для извлечения:<br>
<input type="text" name="count" required><br>
<input type="submit">
</form>

</body>
</html>

<?php
    if(isset($_POST['count'])){
        if(intval($_POST['count']) > 0){
            $MySQL = mysqli_connect("127.0.0.1", "user", "password", "database";
            if (!$MySQL) {
                echo "Error: Unable to connect to MySQL." . PHP_EOL;
                echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                exit;
            }
            $SQL = "SELECT DISTINCT `name`, `id` FROM `EC-codes` ORDER BY RAND() LIMIT ".intval($_POST['count']);
            $request = mysqli_query($MySQL, $SQL);
            while($data = mysqli_fetch_assoc($request)){
                echo $data['id'].") ".$data['name']."<br>";
            }
            mysqli_close($MySQL);
        } else {
            echo "You need > 0 nums";
        }
    }