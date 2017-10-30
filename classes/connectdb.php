<?php 
/*
	Connect to the database once with singleton design
*/

class ConnectDb
{
    private static $instance = null;
    private $mysqli;
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'password';
    private $dbName = 'blog_db';

    private function __construct()
    {
        $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->dbName);

        if ($this->mysqli->connect_error) {
        	die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }
    }

    public static function getInstance()
    {
    	if (!self::$instance) {
    		self::$instance = new ConnectDb();
    	}
    	return self::$instance;
    }

    public function getConnection()
    {
    	return $this->mysqli;
    }
}
?>