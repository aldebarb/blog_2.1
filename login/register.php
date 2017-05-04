<?php
if (isset($_POST['submit'])) {
	$inputArray = array_map('removeMaliciousCode', $_POST);
	$inputArray['firstName'] = checkStringLength($inputArray['firstName'], 32);
	$inputArray['lastName'] = checkStringLength($inputArray['lastName'], 32);
    $inputArray['birthDate'] = date('Y/m/d', strtotime($inputArray['birthDate']));
	$inputArray['emailAddress'] = verifyEmail($inputArray['emailAddress']);
	$inputArray['passwordHash'] = hashUserPassword($inputArray['password']);

    if (!$userLoggedIn->checkEmailRegistration($inputArray['emailAddress'])) {
    	echo "Email address is already taken.";
    
    } elseif (in_array("", $inputArray) || empty($inputArray)) {
        echo "Please enter in the correct information.";
    
    } else {
        $registerUser = new User(0);
        $registerUser->setFirstName($inputArray['firstName']);
        $registerUser->setLastName($inputArray['lastName']);
        $registerUser->setBirthDate($inputArray['birthDate']);
        $registerUser->setEmailAddress(strtolower($inputArray['emailAddress']));
        $registerUser->setPasswordHash($inputArray['passwordHash']);
        $registerUser->save($mysqli);
        header("location: index.php");
    }
}
?>

<h2>Enter your infromation</h2>

<form method="post" action="">
	First Name: <input type="text" name="firstName" value=""><br><br>
	Last Name: <input type="text" name="lastName" value=""><br><br>
	Birth Date: <input type="text" name="birthDate" value=""> mm/dd/yyyy<br><br>
	Email Address: <input type="text" name="emailAddress" value=""><br><br>
	Password: <input type="text" name="password" value=""><br><br>
	<input type="submit" name="submit" value="Submit">	
</form>
