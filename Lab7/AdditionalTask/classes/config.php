<?php

// ------------------------
// MySQL Configuration :
// ------------------------

$db['host'] = "host";
$db['user'] = "user";
$db['pass'] = "password";
$db['name'] = "name";

// ------------------------
// Auth Configuration :
// ------------------------

$auth_conf['site_name'] = "Доставка пиццы"; // Name of website to appear in emails
$auth_conf['email_from'] = "webmaster@holanto.com"; // Email FROM address for Auth emails (Activation, password reset...)
$auth_conf['max_attempts'] = 5; // INT : Max number of attempts for login before user is locked out
$auth_conf['base_url'] = "https://holanto.com/"; // URL to Auth Class installation root WITH trailing slash
$auth_conf['session_duration'] = "+1 month"; // Amount of time session lasts for. Only modify if you know what you are doing ! Default = +1 month
$auth_conf['security_duration'] = "+15 minutes"; // Amount of time to lock a user out of Auth Class afetr defined number of attempts.

$auth_conf['salt_1'] = "us_dUDN4N-53"; // Salt #1 for password encryption
$auth_conf['salt_2'] = "Yu23ds09*d?"; // Salt #1 for password encryption

$loc = "en"; // Language of Auth Class output : en / fr

?>


