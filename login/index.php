<h2>Enter your login Information</h2><br>

<?php

if (isset($_POST['submit'])) {
	$_POST = array_map('removeMaliciousCode', $_POST);
	extract($_POST);

	if ($userLoggedIn->login($emailAddress, $password)) {
		$user = new User($userLoggedIn->getUserId());
		$user->loadUser($mysqli);
		$_SESSION['userId'] = $userLoggedIn->getUserId();
		$_SESSION['loggedIn'] = true;
		header("location: home.php");
	} else {
		echo "<p>Incorrect username and password.</p>";
	}
}
?>

<form method="post" action="">
	Username: <input type="text" name="emailAddress"><br>
	Password: <input type="password" name="password">
	<input type="submit" name="submit" value="Login">
</form><br>

