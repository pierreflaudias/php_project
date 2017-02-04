<?php

/**
* 
*/
class Status
{
	private $id;
	private $content;
	private $date;
	private $user;
	
	function __construct($id, $content, DateTime $date, $user)
	{
		$this->id = $id;
		$this->content = $content;
		$this->date = $date;
		$this->user = $user;
	}
}