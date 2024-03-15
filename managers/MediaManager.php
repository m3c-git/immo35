<?php

class MediaManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findByTypeMedia($type) : ? array
    {
        $query = $this->db->prepare('SELECT * FROM medias WHERE type = :type');
        
        $parameters = [
            "type" => $type,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $medias = [];

        if($results)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new Media($result["url"], $result["property_id"], $result["type"]);
                    $value->setId($result["id"]);
                    $medias[] = $value;
                }
                
            }
            //dump($medias);
            return $medias;
            
        }

    }

    public function findByIdProperty($id) : ? array
    {
        $query = $this->db->prepare('SELECT * FROM medias WHERE property_id = :id');
        
        $parameters = [
            "id" => $id,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $medias = [];

        if($results !== null)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new Media($result["url"], $result["property_id"], $result["type"]);
                    $value->setId($result["id"]);
                    $medias[] = $value;
                }
                
            }
            //dump($results);
            return $medias;
            
        }

    }



    public function createAdmin(User $user) : void
    {

        $currentDateTime = date('Y-m-d H:i:s');


        $query = $this->db->prepare('INSERT INTO users (id, first_name, last_name, address, phone, email, password, role, created_at) VALUES (NULL, :firstName, :lastName, :address, :phone, :email, :password, :role, :createdAt)');
        $parameters = [
            "firstName" => $user->getFirstName(),
            "lastName" => $user->getLastName(),
            "address" => $user->getAddress(),
            "phone" => $user->getPhone(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "role" => $user->getRole(),
            "createdAt" => $currentDateTime,
        ];

        $query->execute($parameters);

        $user->setId($this->db->lastInsertId());

    }

    public function createUser(User $user) : void
    {

        $currentDateTime = date('Y-m-d H:i:s');


        $query = $this->db->prepare('INSERT INTO users (id, first_name, last_name, address, phone, email, password, role, created_at) VALUES (NULL, :firstName, :lastName, :address, :phone, :email, NULL, :role, :createdAt)');
        $parameters = [
            "firstName" => $user->getFirstName(),
            "lastName" => $user->getLastName(),
            "address" => $user->getAddress(),
            "phone" => $user->getPhone(),
            "email" => $user->getEmail(),
            "role" => $user->getRole(),
            "createdAt" => $currentDateTime,
        ];

        $query->execute($parameters);

        $user->setId($this->db->lastInsertId());

    }

    public function updateUser(int $userId) : void
    {
        if(isset($_POST))
        {
       
           $userId = intval($_POST['userId']) ;
           $firstName = $this->CheckInput($_POST['firstName']);
           $lastName = $this->CheckInput($_POST['lastName']);
           $address = $this->CheckInput($_POST['address']);
           $phone = $this->CheckInput($_POST['phone']);
           $email = $this->checkInput($_POST['email']); // Il faut prendre le nom de l'attribut "id" dans lesfomulaires
           $role = $this->CheckInput($_POST['role']);       
       
           
          /* Lors du INSERT à ne pas mettre les colonne entre double quote ou quote simple.
           N pas mettre les valeurs du VALUE entre backquote*/
           $query = $this->db->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, address = :address, phone = :phone, email = :email,  role = :role WHERE id = :id");
           $parameters = [
               'id' => $userId, 'first_name' => $firstName, 'last_name' => $lastName, 'address' => $address, 'phone' => $phone, 'email' => $email, 'role' => $role,
               ];
           $query->execute($parameters);
       
        }
    }

    public function deleteUser( int $userId) : void
    {
        $query = $this->db->prepare('DELETE FROM users WHERE id=:id');
        $parameters = [
            "id" => $userId,
        ];
        $query->execute($parameters);

        /* foreach($this->user as $key => $item)
        {
            if($item->getId() === $user->getId())
            {
                unset($this->users[$key]);
            }
        } */
    }


}