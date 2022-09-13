<?php

// Creation de la Classe User // 

class User
{
    private $idUser;
    private $userName;
    private $email;
    private $password;

    public function __construct($idUser = null, $userName = null, $email = null, $password = null)
    {
        $this->idUser = $idUser;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
    }

    // GETTER //

    public function getIdUser()
    {
        return $this->idUser;
    }

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

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }
}
