<?php

namespace Dal\Sql;

use Dal\FinderInterface;
use Model\Status;
use Model\User;

class StatusFinder implements FinderInterface
{

    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get all statuses from database
     *
     * @param mixed $criteria
     * @return array(Status)
     */
    public function findAll($criteria = [])
    {
        $statuses = [];
        $query = "SELECT s.id, s.content, s.date, u.login FROM statuses s LEFT JOIN users u ON s.user_id = u.id ";
        foreach ($criteria as $criterion => $value) {
            $query .= strtoupper($criterion) . " " . $value . " ";
        }
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        if ($stmt != false) {
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if (!empty($results)) {
                foreach ($results as $row) {
                    $statuses[$row['id']] = new Status($row['id'], $row['content'], new \DateTime($row['date']),
                        $row['login']);
                }
            }
        }
        return $statuses;
    }

    /**
     * Get one status by its id in database
     *
     * @param mixed $id
     * @return Status
     */
    public function findOneById($id)
    {
        $query = "SELECT s.id, s.content, s.date, u.login FROM statuses AS s, users AS u WHERE s.id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result != null) {
            return new Status($result['id'], $result['content'], new \DateTime($result['date']), $result['login']);
        }
    }

    public function findAllByUser(User $user, $criteria = [])
    {

    }

    /**
     * @param $name
     * @param $arguments
     * @return array(Status)
     */
    public function __call($name, $arguments)
    {
        $criteria = [];
        if (preg_match("#^findAll#i", $name)) {
            $match = str_replace("findAll", "", $name);
            if (preg_match("#^ByUser#i", $match)) {
                $match = str_replace("ByUser", "", $match);
                $call = "findAllByUser";

            } else {
                $call = "findAll";
            }
            $findConditions = explode("And", $match);
            foreach ($findConditions as $condition) {
                $criteria[strtolower(preg_replace('/(\w+)([A-Z])/U', '\\1 \\2', $condition))] =  array_shift($arguments);
            }
            return $this->$call($criteria);
        }
    }

}