<?php
/* Schema
    forum (post_id, user_id, post_title, post_blog, post_date, post_time)
    users (user_id, first_name, last_name, birth_date)
    user_login(login_id, user_id, email_address, password_hash)
*/

class User
{
	protected $userId;
	protected $firstName;
	protected $lastName;
	protected $emailAddress;
	protected $password;
	protected $passwordHash;

	public function __construct($userId)
	{
		$this->userId = $userId;
	}
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}
	public function setLastName($lastName) 
	{
		$this->lastName = $lastName;
	}
	public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }
	public function setEmailAddress($emailAddress)
	{
		$this->emailAddress = $emailAddress;
	}
    public function setPassword($password)
    {
    	$this->password = $password;
    }
    public function setPasswordHash($passwordHash)
    {
    	$this->passwordHash = $passwordHash;
    }
    public function save($mysqli)
	{
		if ($this->userId == 0) {
	        $this->createUserInDatabase($mysqli);
	        
		} else {
			$this->updateUserInDatabase($mysqli);
		}
	}
	private function createUserInDatabase($mysqli)
	{
        $mysqli->query("INSERT INTO users (first_name, last_name, birth_date) VALUES ('$this->firstName', '$this->lastName', '$this->birthDate')");
        $this->userId = mysqli_insert_id($mysqli);
        $mysqli->query("INSERT INTO user_login (user_id, email_address, password_hash) VALUES ('$this->userId', '$this->emailAddress', '$this->passwordHash')");
	}
	private function updateUserInDatabase($mysqli)
	{		
		$mysqli->query("UPDATE users SET first_name = '$this->firstName', last_name = '$this->lastName', birth_date = '$this->birthDate' WHERE user_id = '$this->userId'");
		$mysqli->query("UPDATE user_login SET email_address = '$this->emailAddress', password_hash = '$this->passwordHash'");
	}
	public function deleteUser($mysqli)
	{
		$mysqli->query("DELETE FROM users WHERE user_id = '$this->userId'");
		$mysqli->query("DELETE FROM user_login WHERE user_id = '$this->userId'");
	}
	public function loadUser($mysqli)
	{		
		$sql = "SELECT u.first_name, u.last_name, u.birth_date, ul.email_address, ul.password_hash FROM users AS u JOIN user_login AS ul ON u.user_id = ul.user_id WHERE u.user_id = '$this->userId'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			
			while ($row = $result->fetch_assoc()) {
				$this->firstName = $row['first_name'];
				$this->lastName = $row['last_name'];
				$this->birthDate = $row['birth_date'];
				$this->emailAddress = $row['email_address'];
				$this->passwordHash = $row['password_hash'];
			}
		}
	}
}
?>