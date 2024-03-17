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
                    $value->setMedia($result["type_media"]);
                    $types[] = $value;
                }

            }

            return $types;
        }   

    }
    
        public function findByType(string $type) : ? array
    {
        $query = $this->db->prepare('SELECT propertys.*, status_property.*, states.*, types.*, location.*, owner.*, tenant.*, rental_management.*, energy_diagnostics.*, greenhouse_gas_emission_indices.* FROM propertys 
        JOIN types 
        ON propertys.types_id = types.id 
        JOIN status_property ON propertys.status_property_id = status_property.id
        JOIN states ON propertys.state_id = states.id
        JOIN location ON propertys.location_id = location.id
        JOIN users owner ON propertys.owner_id = owner.id
        LEFT JOIN users tenant ON propertys.tenant_id = tenant.id
        JOIN rental_management ON propertys.rental_management_id = rental_management.id
        JOIN energy_diagnostics ON propertys.energy_diagnostics_id = energy_diagnostics.id
        JOIN greenhouse_gas_emission_indices ON propertys.greenhouse_gas_emission_indices_id = greenhouse_gas_emission_indices.id 
        WHERE types.type_name = :type');

        $parameters = [
            "type" => $type
        ];

        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_NAMED);
        //dump($results);
        if($results ==! null)
        {
            foreach($results as $result)
            { //dump($result);
                if($result)
                {
                    $statusProperty = new StatusProperty($result["status_name"]);
                    $state = new State($result["state_name"]);
                    $type = new Type($result["type_name"]);
                    $type->setMedia($result["type_media"]);
                    $location = new Location($result["city"]);
                    $owner = new User($result["first_name"][0], $result["last_name"][0], $result["address"][0], $result["phone"][0], $result["email"][0], NULL, $result["role"][0]);
                    $tenant = null;
                    if( $result["tenant_id"] !== null)
                    {
                        $tenant = new User($result["first_name"][1], $result["last_name"][1], $result["address"][1], $result["phone"][1], $result["email"][1], NULL, $result["role"][1]);
                        $tenant->setId($result["tenant_id"]);
                    }
                    
                    $rentalManagement = new RentalManagement($result["management"]);

                    $value = new Property($statusProperty, $state, $type, $result["availability_date"], $result["title"], $result["rooms"], $result["surface"], $result["description"], $location, $owner, $tenant, $rentalManagement);
                    $value->setId($result["id"][0]); 
                    $value->setSalesPrice($result["sales_price"]);
                    $value->setRent($result["rent"]);
                    $value->setRentCharge($result["rent_charge"]);
                    $value->setCharge($result["charge"]);
                    $value->setSecurityDeposit($result["security_deposit"]);
                    $value->setAgencyFees($result["agency_fees_rent"]);
                    $value->getEnergyDiagnostics()->setId($result["energy_diagnostics_id"]);
                    $value->getEnergyDiagnostics()->setNote($result["note_energy_diagnostics"]);
                    $value->getGreenhouseGasEmissionIndices()->setId($result["greenhouse_gas_emission_indices_id"]);
                    $value->getGreenhouseGasEmissionIndices()->setNote($result["note_greenhouse_gas_emission_indices"]);
                    $statusProperty->setId($result["status_property_id"]);
                    $state->setId($result["state_id"]);
                    $type->setId($result["types_id"]);
                    $location->setId($result["location_id"]);
                    $owner->setId($result["owner_id"]);
                    
                    $rentalManagement->setId($result["rental_management_id"]);

                    $propertys[] = $value;
                }

            }

            return $propertys;
        } 
        return null;

    }

    public function findOne(int $id) : ? Property
    {
        $query = $this->db->prepare('SELECT propertys.*, status_property.*, states.*, types.*, location.*, owner.*, tenant.*, rental_management.*, energy_diagnostics.*, greenhouse_gas_emission_indices.* FROM propertys 
        JOIN types 
        ON propertys.types_id = types.id 
        JOIN status_property ON propertys.status_property_id = status_property.id
        JOIN states ON propertys.state_id = states.id
        JOIN location ON propertys.location_id = location.id
        JOIN users owner ON propertys.owner_id = owner.id
        LEFT JOIN users tenant ON propertys.tenant_id = tenant.id
        JOIN rental_management ON propertys.rental_management_id = rental_management.id
        JOIN energy_diagnostics ON propertys.energy_diagnostics_id = energy_diagnostics.id
        JOIN greenhouse_gas_emission_indices ON propertys.greenhouse_gas_emission_indices_id = greenhouse_gas_emission_indices.id 
        WHERE propertys.id = :id');;

        $parameters = [
            "id" => $id
        ];

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_NAMED);

         
        //dump($result);
        if($result !== null)
        {

            $statusProperty = new StatusProperty($result["status_name"]);
            $state = new State($result["state_name"]);
            $type = new Type($result["type_name"]);
            $type->setMedia($result["type_media"]);
            $location = new Location($result["city"]);
            $owner = new User($result["first_name"][0], $result["last_name"][0], $result["address"][0], $result["phone"][0], $result["email"][0], NULL, $result["role"][0]);
            $tenant = null;
            if( $result["tenant_id"] !== null)
            {
                $tenant = new User($result["first_name"][1], $result["last_name"][1], $result["address"][1], $result["phone"][1], $result["email"][1], NULL, $result["role"][1]);
                $tenant->setId($result["tenant_id"]);
            }
            
            $rentalManagement = new RentalManagement($result["management"]);

            $property = new Property($statusProperty, $state, $type, $result["availability_date"], $result["title"], $result["rooms"], $result["surface"], $result["description"], $location, $owner, $tenant, $rentalManagement);
            $property->setId($result["id"][0]); 
            $property->setSalesPrice($result["sales_price"]);
            $property->setRent($result["rent"]);
            $property->setRentCharge($result["rent_charge"]);
            $property->setCharge($result["charge"]);
            $property->setSecurityDeposit($result["security_deposit"]);
            $property->setAgencyFees($result["agency_fees_rent"]);
            $property->getEnergyDiagnostics()->setId($result["energy_diagnostics_id"]);
            $property->getEnergyDiagnostics()->setNote($result["note_energy_diagnostics"]);
            $property->getGreenhouseGasEmissionIndices()->setId($result["greenhouse_gas_emission_indices_id"]);
            $property->getGreenhouseGasEmissionIndices()->setNote($result["note_greenhouse_gas_emission_indices"]);
            $statusProperty->setId($result["status_property_id"]);
            $state->setId($result["state_id"]);
            $type->setId($result["types_id"]);
            $location->setId($result["location_id"]);
            $owner->setId($result["owner_id"]);
            
            $rentalManagement->setId($result["rental_management_id"]);
            //dump($property);

            return $property;
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

    public function updateProperty(int $propertyId) : void
    {
        if(isset($_POST))
        {
       
           $propertyId = intval($_POST['propertyId']) ;
           $status_property_id = $this->CheckInput($_POST['statusId']);
           $state_id = $this->CheckInput($_POST['stateId']);
           $types_id = $this->CheckInput($_POST['typeId']);
           $availability_date = $this->CheckInput($_POST['availabilityDate']);
           $title = $this->checkInput($_POST['title']); // Il faut prendre le nom de l'attribut "id" dans lesfomulaires
           $rooms = $this->CheckInput($_POST['rooms']); 
           $surface = $this->CheckInput($_POST['surface']);
           $description = $this->CheckInput($_POST['description']);
           $location_id  = $this->CheckInput('1');

           if($this->CheckInput($_POST['salesPrice']) === '')
           {
                $sales_price = NULL;
           }
           else
           {
            $sales_price = $this->CheckInput($_POST['salesPrice']);

           }

           if($this->CheckInput($_POST['rent']) === '')
           {
                $rent = NULL;
           }
           else
           {
                $rent = $this->CheckInput($_POST['rent']);

           }

           if($this->CheckInput($_POST['rentCharge']) === '')
           {
                $rent_charge = NULL;
           }
           else
           {
                $rent_charge = $this->CheckInput($_POST['rentCharge']);
           }

           if($this->CheckInput($_POST['charge']) === '')
           {
                $charge = NULL;
           }
           else
           {
                $charge = $this->CheckInput($_POST['charge']);
           }

           if($this->CheckInput($_POST['securityDeposit']) === '')
           {
                $security_deposit = NULL;
           }
           else
           {
                $security_deposit = $this->CheckInput($_POST['securityDeposit']);
           }

           if($this->CheckInput($_POST['agencyFeesRent']) === '')
           {
                $agency_fees_rent = NULL;
           }
           else
           {
                $agency_fees_rent = $this->CheckInput($_POST['agencyFeesRent']);
           }

           if($this->CheckInput($_POST['energyDiagnosticsId']) === '')
           {
                $energy_diagnostics_id = NULL;
           }
           else
           {
                $energy_diagnostics_id = $this->CheckInput($_POST['energyDiagnosticsId']);
           }

           if($this->CheckInput($_POST['greenhouseGasEmissionIndicesId']) === '')
           {
                $greenhouse_gas_emission_indices_id = NULL;
           }
           else
           {
                $greenhouse_gas_emission_indices_id = $this->CheckInput($_POST['greenhouseGasEmissionIndicesId']);
           }

           if($this->CheckInput($_POST['tenantId']) === '')
           {
            $tenant_id = NULL;
           }
           else
           {
                $tenant_id = $this->CheckInput($_POST['tenantId']);   
           }
                        
    
                 
           
/*            $rent = $this->CheckInput($_POST['rent']);
           $rent_charge = $this->CheckInput($_POST['rentCharge']);
           $charge = $this->CheckInput($_POST['charge']);
           $security_deposit = $this->CheckInput($_POST['securityDeposit']);
           $agency_fees_rent = $this->CheckInput($_POST['agencyFeesRent']);
           $energy_diagnostics_id = $this->CheckInput($_POST['energyDiagnosticsId']);
           $greenhouse_gas_emission_indices_id = $this->CheckInput($_POST['greenhouseGasEmissionIndicesId']); */
           $owner_id = $this->CheckInput($_POST['ownerId']);
           //$tenant_id = $this->CheckInput($_POST['tenantId']);
           $rental_management_id = $this->CheckInput($_POST['rentalManagementId']);
           //$medias = $this->CheckInput($_FILES);
           //$propertyFeatures = $this->CheckInput($_POST['features']);


           
          /* Lors du INSERT à ne pas mettre les colonne entre double quote ou quote simple.
           N pas mettre les valeurs du VALUE entre backquote*/
           $query = $this->db->prepare("UPDATE propertys SET status_property_id = :status_property_id, state_id = :state_id, types_id = :types_id, availability_date = :availability_date, title = :title,  rooms = :rooms, surface = :surface, description = :description, location_id = :location_id, sales_price = :sales_price, rent = :rent, rent_charge = :rent_charge, charge = :charge, security_deposit = :security_deposit, agency_fees_rent = :agency_fees_rent, energy_diagnostics_id = :energy_diagnostics_id, greenhouse_gas_emission_indices_id = :greenhouse_gas_emission_indices_id, owner_id = :owner_id, tenant_id = :tenant_id, rental_management_id = :rental_management_id WHERE id = :id");
           $parameters = [
               'id' => $propertyId,
               'status_property_id' => $status_property_id,
               'state_id' => $state_id,
               'types_id' => $types_id,
               'availability_date' => $availability_date,
               'title' => $title,
               'rooms' => $rooms,
               'surface' => $surface,
               'description' => $description,
               'location_id'  => $location_id,
               'sales_price' => $sales_price,     
               'rent' => $rent,
               'rent_charge' => $rent_charge,
               'charge' => $charge,
               'security_deposit' => $security_deposit,
               'agency_fees_rent' => $agency_fees_rent,
               'energy_diagnostics_id' => $energy_diagnostics_id,
               'greenhouse_gas_emission_indices_id' => $greenhouse_gas_emission_indices_id,
               'owner_id' => $owner_id,
               'tenant_id' => $tenant_id,
               'rental_management_id' => $rental_management_id,
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