<?php
/* Schema
    forum (post_id, user_id, post_title, post_blog, post_date, post_time)
    users (user_id, first_name, last_name, birth_date)
    user_login(login_id, user_id, email_address, password_hash)
*/

class UserLogin
{
	protected $mysqli;
	protected $userId;

	function __construct($mysqli)
	{
		$this->mysqli = $mysqli;
	}
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}
	public function getUserId()
	{
		return $this->userId;
	}
	public function isLoggedIn()
	{
		if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
			return true;
		}
	}
	private function getUserHash($emailAddress)
	{
		$sql = "SELECT user_id, password_hash FROM user_login WHERE email_address = '$emailAddress'";
		$result = $this->mysqli->query($sql);

		if ($result->num_rows > 0) {
			
			while ($row = $result->fetch_assoc()) {
				$this->userId = $row['user_id'];
				return $row['password_hash'];
			}
		}
	}
	public function login($emailAddress, $password)
	{
		$hashed = $this->getUserHash($emailAddress);

		if (password_verify($password, $hashed) == 1) {
			return true;
		}
		return false;
	}
	public function checkEmailRegistration($emailAddress)
	{
		$sql = "SELECT email_address FROM user_login";
		$result = $this->mysqli->query($sql);

		if ($result->num_rows > 0) {
			
			while ($row = $result->fetch_assoc()) {
				$tableEmailAddress = $row['email_address'];

				if ($tableEmailAddress == $emailAddress) {
					return false;
				}
			}
		}
		return true;
	}
	public function logout()
	{
		session_destroy();
	}
}
?>