<?php
/*
Author: Lerie Taylor
Date: 2021
Filename: User.class.php
Description: A generic User object
*/
class User
{
	public $logged_in = false;
	private $email;
	private $id;
	private $db;

	function __construct($dbh)
	{
		$this->db = $dbh;
	}

	function login($email,$pass)
	{
		if($this->db->emailExists($email))
		{
			($this->db->checkLogin($email, $pass) ? $this->logged_in = "true" : $this->logged_in = "false");

			return $this->logged_in;
		} else {
			return false;
		}
	}
}
?>