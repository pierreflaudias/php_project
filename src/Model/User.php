<?php

namespace Model;

class User
{
    private $id;
    private $login;
    private $password;

    function __construct($id = null, $login, $password)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
