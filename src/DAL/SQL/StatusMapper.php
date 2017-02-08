<?php

use Connection;

namespace DAL\SQL;

class StatusMapper
{
	private $connection;
	
	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
	}

	public function persist(Status $status)
	{
		$this->connection->executeQuery();
	}

	public function remove(Status $status)
	{
		$this->connection->executeQuery();
	}
}