<?php

use Connection;

namespace DAL\SQL;

class SQLFinder extends FinderInterface
{

	private $connection;

	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
	}
	
	public function findAll()
	{
		$statuses = [];
		$query = "SELECT id, content, user, date FROM Statuses";
		$results = $this->connection->prepare($query)->execute()->fetchObject('Status');

		if(!empty($results)){
			for
		}
	}

	public function findOneById($id)
	{
		
	}
}