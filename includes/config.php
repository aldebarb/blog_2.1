<?php 
/* Session security
    Prevent the cookie from being accessed by scripting languages and reduce theft throught XSS attacks
*/
    
ini_set('session.cookie_httponly', true);
session_start();
if (isset($_SESSION['last_ip']) === false) {
	$_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
}
if ($_SESSION['last_ip'] !== $_SERVER['REMOTE_ADDR']) {
	session_unset();
	session_destroy();
}

function __autoload($class)
{
	$class = strtolower($class);
	$classPath = 'classes/' . $class . '.php';

	if (file_exists($classPath)) {
		require $classPath;
	}

	$classPath = '../classes/' . $class . '.php';
	if (file_exists($classPath)) {
		require $classPath;
	}

	$classPath = '../../classes/' . $class . '.php';
	if (file_exists($classPath)) {
		require $classPath;
	}
}

$instance = ConnectDb::getInstance();
$mysqli = $instance->getConnection();
$userLoggedIn = new UserLogin($mysqli);
?>