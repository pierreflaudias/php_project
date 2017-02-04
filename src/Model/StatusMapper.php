<?php

use Connection;
/**
* 
*/
class StatusMapper
{
	private $connection;
	
	function __construct(Connection $connection)
	{
		$this->connection = $connection;
	}
}