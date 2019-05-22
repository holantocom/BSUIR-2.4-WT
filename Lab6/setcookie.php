<?php

$cookie_name = $_POST['name'] ?? "";
if ($cookie_name === "") {
	exit("Необходимо ввести название cookie!");
}

$cookie_value = $_POST['value'] ?? "";
if ($cookie_value === "") {
	exit("Необходимо ввести значение cookie!");
}

$days = $_POST['days'] ?? "";
if ($days === "") {
	$days = 0;
} elseif (!is_numeric($days)) {
	exit("Количество дней должно быть числом!");
}

$hours = $_POST['hours'] ?? "";
if ($hours === "") {
	$hours = 0;
} elseif (!is_numeric($hours)) {
	exit("Количество часов должно быть числом!");
}

$minutes = $_POST['minutes'] ?? "";
if ($minutes === "") {
	$minutes = 0;
} elseif (!is_numeric($minutes)) {
	exit("Количество минут должно быть числом!");
}

$seconds = $_POST['seconds'] ?? "";
if ($seconds === "") {
	$seconds = 0;
} elseif (!is_numeric($seconds)) {
	exit("Количество секунд должно быть числом!");
}

const SECONDS_IN_DAY = 60 * 60 * 24;
const SECONDS_IN_HOUR = 60 * 60;
const SECONDS_IN_MINUTE = 60;

$expire_date = time()
	+ $days * SECONDS_IN_DAY
	+ $hours * SECONDS_IN_HOUR
	+ $minutes * SECONDS_IN_HOUR
	+ $seconds;

setcookie($cookie_name, $cookie_value, $expire_date);