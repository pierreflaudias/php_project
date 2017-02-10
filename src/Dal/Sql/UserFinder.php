<?php
/**
 * Created by PhpStorm.
 * User: piflaudias
 * Date: 10/02/17
 * Time: 11:54
 */

namespace Dal\Sql;


use Model\User;

class UserFinder
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findOneByLogin($login)
    {
        $user = null;
        $query = "SELECT * FROM users where login=:login";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(["login" => $login]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!empty($result)) {
            $user = new User($result['id'], $result['login'], $result['password']);
        }
        return $user;
    }
}