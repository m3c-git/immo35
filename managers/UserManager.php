<?php

class UserManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findByEmail(string $email) : ? User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE email=:email');

        $parameters = [
            "email" => $email
        ];

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $user = new User($result["first_name"], $result["last_name"], $result["address"], $result["phone"], $result["email"], $result["password"], $result["role"], $result["created_at"]);
            $user->setId($result["id"]);

            return $user;
        }

        return null;
    }

    public function findByRole(string $role) : ? User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE role = :role');

        $parameters = [
            "role" => $role
        ];

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $users = new User($result["first_name"], $result["last_name"], $result["address"], $result["phone"], $result["email"], $result["password"], $result["role"], $result["created_at"]);
            $users->setId($result["id"]);

            return $users;
        }

        return null;
    }

    public function findOne(int $id) : ? User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE id=:id');

        $parameters = [
            "id" => $id
        ];

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $user = new User($result["first_name"], $result["last_name"], $result["address"], $result["phone"], $result["email"], $result["password"], $result["role"], $result["created_at"]);
            $user->setId($result["id"]);

            return $user;
        }

        return null;
    }

    public function create(User $user) : void
    {

        $currentDateTime = date('Y-m-d H:i:s');

        $query = $this->db->prepare('INSERT INTO users (id, first_name, last_name, address, phone, email, password, role, created_at) VALUES (NULL, :first_name, :last_name, :address, :phone, :email, :password, :role, :created_at)');
        $parameters = [
            "first_name" => $user->getFirstName(),
            "last_name" => $user->getLastName(),
            "address" => $user->getAddress(),
            "phone" => $user->getPhone(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "role" => $user->getRole(),
            "created_at" => $currentDateTime
        ];

        $query->execute($parameters);

        $user->setId($this->db->lastInsertId());

    }
}