<?php

namespace Model;

class User
{
    private $id;
    private $login;
    private $password;

    function __construct($id, $login, $password)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
}