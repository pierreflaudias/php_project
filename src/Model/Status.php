<?php

namespace Model;

class Status
{
    private $id;
    private $content;
    private $created_at;
    private $user_login;

    function __construct($id = null, $content, \DateTime $created_at, $user_login = null)
    {
        $this->id = $id;
        $this->content = $content;
        $this->created_at = $created_at;
        $this->user_login = ($user_login == null) ? "Anonymous user" : $user_login;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUserLogin()
    {
        return $this->user_login;
    }

    public function setUserLogin($user_login)
    {
        $this->user_login = $user_login;
    }
}