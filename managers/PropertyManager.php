<?php

class PropertyManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll() : ? array
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
        JOIN greenhouse_gas_emission_indices ON propertys.greenhouse_gas_emission_indices_id = greenhouse_gas_emission_indices.id');

        

        $query->execute();
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
                    $value->setAgencyFeesRent($result["agency_fees_rent"]);
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
        WHERE propertys.id = :id');

        $parameters = [
            "id" => $id
        ];

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_NAMED);

        //dump($result);
        if($result !== false)
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
            $property->setAgencyFeesRent($result["agency_fees_rent"]);
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

    public function findByStatus(string $status) : ? array
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
        WHERE status_property.status_name = :status');

        $parameters = [
            "status" => $status
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
                    $value->setAgencyFeesRent($result["agency_fees_rent"]);
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

    public function findByStatus4Last(string $status) : ? array
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
        WHERE status_property.status_name = :status ORDER BY propertys.id DESC LIMIT 4');

        $parameters = [
            "status" => $status
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
                    $value->setAgencyFeesRent($result["agency_fees_rent"]);
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
                    $value->setAgencyFeesRent($result["agency_fees_rent"]);
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

    public function findByLocation(string $location) : ? array
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
        WHERE location.city = :location');

        $parameters = [
            "location" => $location
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
                    $value->setAgencyFeesRent($result["agency_fees_rent"]);
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

    public function findByStatusAndType(string $status, string $type,) : ? array
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
        WHERE status_property.status_name = :status AND types.type_name = :type');

        $parameters = [
            "status" => $status,
            "type" => $type,
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
                    $value->setAgencyFeesRent($result["agency_fees_rent"]);
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
    
    public function findByStatusAndLocation(string $status, string $location) : ? array
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
        WHERE status_property.status_name = :status AND location.city = :location');

        $parameters = [
            "status" => $status,
            "location" => $location
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
                    $value->setAgencyFeesRent($result["agency_fees_rent"]);
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

    public function findByTypeAndLocation(string $type, string $location) : ? array
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
        WHERE types.type_name = :type AND location.city = :location');

        $parameters = [
            "type" => $type,
            "location" => $location
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
                    $value->setAgencyFeesRent($result["agency_fees_rent"]);
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

    public function findByStatusAndTypeAndLocation(string $status, string $type, string $location) : ? array
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
        WHERE status_property.status_name = :status AND types.type_name = :type AND location.city = :location');

        $parameters = [
            "type" => $type,
            "location" => $location,
            "status" => $status
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
                    $value->setAgencyFeesRent($result["agency_fees_rent"]);
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

    public function createProperty(Property $property) : void
    {
        
       

        if($property->getTenant() === null)
        {
            $tenant = null;
        }
        else
        {
            $tenant = $property->getTenant()->getId();
        }
        
        $query = $this->db->prepare('INSERT INTO propertys (id, status_property_id, state_id, types_id, availability_date, title, rooms, surface, description, location_id, sales_price, rent, rent_charge, charge, security_deposit, agency_fees_rent, energy_diagnostics_id, greenhouse_gas_emission_indices_id, owner_id, tenant_id, rental_management_id) VALUES (NULL, :status_property_id, :state_id, :types_id, :availability_date, :title, :rooms, :surface, :description, :location_id, :sales_price, :rent, :rent_charge, :charge, :security_deposit, :agency_fees_rent, :energy_diagnostics_id, :greenhouse_gas_emission_indices_id, :owner_id, :tenant_id, :rental_management_id)');
        $parameters = [
            "status_property_id" => $property->getStatusProperty()->getId(),
            "state_id" => $property->getState()->getId(),
            "types_id" => $property->getType()->getId(),
            "availability_date" => $property->getAvailabilityDate(),
            "title" => $property->getTitle(),
            "rooms" => $property->getRooms(),
            "surface" => $property->getSurface(),
            "description" => $property->getDescription(),
            "location_id" => $property->getLocation()->getId(),
            "sales_price" => $property->getSalesPrice(),
            "rent" => $property->getRent(),
            "rent_charge" => $property->getRentCharge(),
            "charge" => $property->getCharge(),
            "security_deposit" => $property->getSecurityDeposit(),
            "agency_fees_rent" => $property->getAgencyFeesRent(),
            "energy_diagnostics_id" => $property->getEnergyDiagnostics()->getId(),
            "greenhouse_gas_emission_indices_id" => $property->getGreenhouseGasEmissionIndices()->getId(),
            "owner_id" => $property->getOwner()->getId(),
            "tenant_id" => $tenant,
            "rental_management_id" => $property->getRentalManagement()->getId(),
        ];

        $query->execute($parameters);

        $property->setId($this->db->lastInsertId());
        

    }

    public function updateProperty(Property $property) : void
    {
 
        if($property->getTenant() === null)
        {
            $tenant = null;
        }
        else
        {
            $tenant = $property->getTenant()->getId();
        }

          /* Lors du INSERT à ne pas mettre les colonne entre double quote ou quote simple.
           N pas mettre les valeurs du VALUE entre backquote*/
           $query = $this->db->prepare("UPDATE propertys SET status_property_id = :status_property_id, state_id = :state_id, types_id = :types_id, availability_date = :availability_date, title = :title,  rooms = :rooms, surface = :surface, description = :description, location_id = :location_id, sales_price = :sales_price, rent = :rent, rent_charge = :rent_charge, charge = :charge, security_deposit = :security_deposit, agency_fees_rent = :agency_fees_rent, energy_diagnostics_id = :energy_diagnostics_id, greenhouse_gas_emission_indices_id = :greenhouse_gas_emission_indices_id, owner_id = :owner_id, tenant_id = :tenant_id, rental_management_id = :rental_management_id WHERE id = :id");
           $parameters = [
            "id" => $property->getId(),
            "status_property_id" => $property->getStatusProperty()->getId(),
            "state_id" => $property->getState()->getId(),
            "types_id" => $property->getType()->getId(),
            "availability_date" => $property->getAvailabilityDate(),
            "title" => $property->getTitle(),
            "rooms" => $property->getRooms(),
            "surface" => $property->getSurface(),
            "description" => $property->getDescription(),
            "location_id" => $property->getLocation()->getId(),
            "sales_price" => $property->getSalesPrice(),
            "rent" => $property->getRent(),
            "rent_charge" => $property->getRentCharge(),
            "charge" => $property->getCharge(),
            "security_deposit" => $property->getSecurityDeposit(),
            "agency_fees_rent" => $property->getAgencyFeesRent(),
            "energy_diagnostics_id" => $property->getEnergyDiagnostics()->getId(),
            "greenhouse_gas_emission_indices_id" => $property->getGreenhouseGasEmissionIndices()->getId(),
            "owner_id" => $property->getOwner()->getId(),
            "tenant_id" => $tenant,
            "rental_management_id" => $property->getRentalManagement()->getId(),
               ];
           $query->execute($parameters);
       
        
    }

    public function deleteProperty( int $propertyId) : void
    {
        $query = $this->db->prepare('DELETE FROM propertys WHERE id = :id');
        $parameters = [
            "id" => $propertyId,
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