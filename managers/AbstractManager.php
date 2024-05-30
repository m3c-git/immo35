<?php

abstract class AbstractManager
{
    protected PDO $db;

    public function __construct()
    {
        try
        {
            $connexion = "mysql:host=".$_ENV["DB_HOST"].";charset=".$_ENV["DB_CHARSET"].";dbname=".$_ENV["DB_NAME"];
            $this->db = new PDO(
                $connexion,
                $_ENV["DB_USER"],
                $_ENV["DB_PASSWORD"]
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $e)
        {
            die($e -> getMessage());
        }
        return $this->db;

        
    }

    public function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}