<?php
require 'includes/config.php';
require 'includes/formUtility.php';

if (!$userLoggedIn->isLoggedIn()) {
	header("location:login/index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Char120 Home</title>
	<link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body>
    <h1>Char120</h1>
    <div id="menu">
	    <a href="home.php">Home</a>
	    <a href="home.php?p=add">Add a Post</a>
	    <a href="login/logout.php">Logout</a>
    </div>
    <div id="content">
	    <?php 
	    $pages_dir = 'admin';

    	if (!empty($_GET['p'])) {
			$pages = scandir($pages_dir, 0);
			unset($pages[0], $pages[1]);
			$p = $_GET['p'];

			if (in_array($p . '.php', $pages)) {
				include ($pages_dir . '/' . $p . '.php');

			} else {
				echo "Page not found";
			}
		
		} else {
			include ($pages_dir . '/home.php');
		}
	    ?>
    </div>
</body>
</html>