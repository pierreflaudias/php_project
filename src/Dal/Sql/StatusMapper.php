<?php



namespace Dal\Sql;
use Dal\Sql\Connection;
use Model\Status;

class StatusMapper
{
	private $connection;
	
	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
	}

	public function persist(Status $status)
	{
        $parameters = array('id' => $status->getId(),
                            'content' => $status->getContent(),
                            'date'=> $status->getCreatedAt(),
                            'user_id' => $status->getUserLogin()
            );

        $query = "INSERT INTO statuses(id,content, date, user_id) values(:id,:content,:date,:user_id)";

		return $this->connection->executeQuery($query, $parameters);
	}

	public function remove(Status $status)
	{
		$query = "DELETE FROM statuses WHERE id=:id";
        return $this->connection->executeQuery($query,  ["id" => $status->getId()]);
	}
}