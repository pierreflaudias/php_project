<?php

namespace Dal\Sql;

use Model\Status;
use Dal\FinderInterface;

class SQLFinder implements FinderInterface
{

	private $connection;

	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
	}
	
	public function findAll()
	{
		$statuses = [];
		$query = "SELECT s.id, s.content, s.date, u.login FROM statuses AS s, users AS u WHERE s.user_id = u.id OR s.user_id IS NULL";
		$stmt = $this->connection->prepare($query);
		$stmt->execute();

		if($stmt != false){
			$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		

			if(!empty($results)){
				foreach ($results as $row) {
					$statuses[$row['id']] = new Status($row['id'], $row['content'], new \DateTime($row['date']), $row['login']);
				}
			}
		}
		return $statuses;
	}

	public function findOneById($id)
	{
		$status;
		$query = "SELECT id, content, user, date FROM Statuses WHERE id = :id";
		$result = $this->connection->executeQuery($query, ['id' => $id])->fetchObject('Status');
		
	}

}