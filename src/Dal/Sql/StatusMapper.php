<?php


namespace Dal\Sql;

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
        $user_finder = new UserFinder($this->connection);
        $user = $user_finder->findOneByLogin($status->getUserLogin());
        $user_id = null;
        if($user != null) {
            $user_id = $user->getId();
        }
        $parameters = array(
            'content' => $status->getContent(),
            'date' => $status->getCreatedAt()->format('Y-d-m'),
            'user_id' => $user_id
            );

        $query = "INSERT INTO statuses(content, date, user_id) values(:content,:date,:user_id)";

        $this->connection->executeQuery($query, $parameters);

        return $this->connection->lastInsertId();
    }

    public function remove(Status $status)
    {
        $query = "DELETE FROM statuses WHERE id=:id";
        return $this->connection->executeQuery($query, ["id" => $status->getId()]);
    }
}