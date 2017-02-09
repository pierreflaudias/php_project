<?php

namespace Model;

class User
{
	private $id;
	private $login;
	private $password;

	function __construct($id, $login, $password)
	{
		$this->id = $id;
		$this->login = $login;
		$this->password = $password;
	}
}