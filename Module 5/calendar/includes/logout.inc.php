<?php
ini_set('session.cookie_secure', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.use_only_cookies', '1');
session_start();
session_destroy();
echo json_encode(array(
	"loggedout" => true,
));
exit();