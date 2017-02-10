<?php


namespace Dal\Sql;
use Dal\Sql\Connection;
use Model\User;

class UserMapper
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function persist(User $user)
    {
        $parameters = array('id' => $user->getId(),
            'login' => $user->getLogin(),
            'password'=> $user->getPassword()
        );

        $query = "INSERT INTO user(id,login,password) values(:id,:login,:password)";

        return $this->connection->executeQuery($query, $parameters);
    }

    public function remove(User $user)
    {
        $query = "DELETE FROM user WHERE id=:id";
        return $this->connection->executeQuery($query,  ["id" => $user->getId()]);
    }
}