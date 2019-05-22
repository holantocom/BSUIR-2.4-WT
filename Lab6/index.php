<?php

if(isset($_GET['name'])){
    setcookie($_GET['name'], null, -1);
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Клевый сайт для кук</title>
	</head>
	<body>
		<form method="POST">
			Название cookie:<br>
				<input type="text" name="name" required /><br>
			Значение cookie:<br>
				<input type="text" name="value" required /><br>
			Время действия cookie:<br>
			Количество дней:<br>
				<input type="text" name="days"/><br>
			Количество часов:<br>
				<input type="text" name="hours"/><br>
			Количество минут:<br>
				<input type="text" name="minutes"/><br>
			Количество секунд:<br>
				<input type="text" name="seconds"/><br>
				<input name="submit" type="submit" name="button_add" value="Добавить cookie"/>		
		</form>
	</body>
</html>
<?php

if(isset($_POST['submit'])){
    include('setcookie.php');
    echo "<script>location.reload();</script>";
}

if (count($_COOKIE) == 0) {
	echo "<br>Список cookie в настоящее время пуст!" . "<br><br>";
} else {

	echo "<br><b>Название</b> -> <b>Значение</b>" . "<br>";
	foreach ($_COOKIE as $key => $value) {			
		echo '<a href="index.php?name='.$key.'">Удалить</a>  '.$key." -> ".$value."<br>";
	}
}