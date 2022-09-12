<?php

// Creation de la Classe User // 

class User
{

    private $userName;
    private $email;
    private $password;

    public function __construct($userName = null, $email, $password)
    {
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
    }

    // GETTER //

    public function getUserName()
    {
        return $this->userName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // SETTER //

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}
