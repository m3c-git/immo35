<?php

class PropertyManager extends AbstractManager
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

/*     public function findAll() : ? array
    {
        $query = $this->db->prepare('SELECT * FROM propertys');

        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $propertys = [];

        if($results)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new Property($result["first_name"], $result["last_name"], $result["address"], $result["phone"], $result["email"], $result["password"], $result["role"], $result["created_at"]);
                    $value->setId($result["id"]);
                    $user[] = $value;
                }
                
            }
            
            return $user;
            
        }

    }   */
        
    public function findTypes() : ? array
    {
        $query = $this->db->prepare('SELECT * FROM types');

        $parameters = [];

        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        if($results)
        {
            foreach($results as $result)
            { 
                if($result !== null)
                {
                    $value = new Type($result["type_name"]);
                    $value->setId($result["id"]);
                    $types[] = $value;
                }

            }

            return $types;
        }   

    }
    
        public function findByType(string $type) : ? array
    {
        $query = $this->db->prepare('SELECT propertys.*, types.type_name, location.* FROM propertys JOIN types ON propertys.types_id = types.id JOIN location ON propertys.location_id = location.id WHERE types.type_name = :type');

        $parameters = [
            "type" => $type
        ];

        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        if($results)
        {
            foreach($results as $result)
            { 
                if($result !== null)
                {
                    $value = new Property($result["status_property_id"], $result["state_id"], $result["types_id"], $result["availability_date"], $result["title"], $result["rooms"], $result["surface"], $result["description"], $result["location_id"], $result["users_id"], $result["rental_management_id"]);
                    $value->setId($result["id"]); 
                    $value->setSalesPrice($result["sales_price"]);
                    $value->setRent($result["rent"]);
                    $value->setRentCharge($result["rent_charge"]);
                    $value->setCharge($result["charge"]);
                    $value->setSecurityDeposit($result["security_deposit"]);
                    $value->setAgencyFees($result["agency_fees_rent"]);
                    $value->setEnergyPerformanceId($result["energy_performance_id"]);
                    $users[] = $value;
                }

            }

            return $users;
        }   

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