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

    public function findAll()
    {
        $statuses = [];
        $query = "SELECT s.id, s.content, s.date, u.login FROM statuses AS s, users AS u";
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

    public function findAllByUser(User $user)
    {

    }

    private function __call($name, $arguments)
    {
        if (preg_match("#^find#i", $name)) {
            $findQuantity = str_replace("find", "", $name);
            if (preg_match("#^One#i", $findQuantity)) {
                //$findConditions =
            } elseif (preg_match("#^All#i", $findQuantity)) {

            }
        }
    }

}