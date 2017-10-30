<?php 
//Session security
ini_set('session.cookie_httponly', true);
session_start();
if (isset($_SESSION['last_ip']) === false) {
	$_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
}
if ($_SESSION['last_ip'] !== $_SERVER['REMOTE_ADDR']) {
	session_unset();
	session_destroy();
}

date_default_timezone_set('America/New_York');
/* Create a connect class and Remove this section *
$mysqli = new mysqli('localhost', 'root', 'password', 'blog_db');

if ($mysqli->connect_error) {
	die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
*/
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