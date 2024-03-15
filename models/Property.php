<?php


class Property
{
    private ? int $id = null;
    private ? int $salesPrice = null; 
    private ? int $rent = null;
    private ? int $rentCharge = null;
    private ? int $charge = null;
    private ? int $securityDeposit = null;
    private ? int $agencyFeesRent = null;
    private ? EnergyDiagnostics $energyDiagnostics;
    private ? GreenhouseGasEmissionIndices $greenhouseGasEmissionIndices;
    private ? array $medias;
    private ? array $propertyFeatures;


    public function __construct(private StatusProperty $statusProperty, private State $state, private Type $type, private string $availabilityDate, private string $title, private int $rooms, private int $surface, private string $description, private Location $location, private User $owner, private ? User $tenant, private RentalManagement $rentalManagement)
    {
        $this->energyDiagnostics = new EnergyDiagnostics("", "");
        $this->greenhouseGasEmissionIndices = new GreenhouseGasEmissionIndices("", "");

    }

    /**
     * Get the value of id
     *
     * @return  int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param   int  $id  
     *
     */
    public function setId($id): void
    {
        $this->id = $id;

    }
    


    /**
     * Get the value of statusProperty
     *
     * @return  StatusProperty
     */
    public function getStatusProperty(): StatusProperty
    {
        return $this->statusProperty;
    }

    /**
     * Set the value of statusProperty
     *
     * @param   StatusProperty  $statusProperty
     *
     */
    public function setStatusProperty($statusProperty): void
    {
        $this->statusProperty = $statusProperty;

    }

    /**
     * Get the value of state
     *
     * @return  State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @param   State  $state  
     *
     */
    public function setStateId($state): void
    {
        $this->state = $state;

    }

    /**
     * Get the value of type
     *
     * @return  Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param   Type  $type
     *
     */
    public function setType($type): void
    {
        $this->type = $type;

    }

    /**
     * Get the value of availabilityDate
     *
     * @return  string
     */
    public function getAvailabilityDate(): string
    {
        return $this->availabilityDate;
    }

    /**
     * Set the value of availabilityDate
     *
     * @param   string  $availabilityDate  
     *
     */
    public function setAvailabilityDate(string $availabilityDate): void
    {
        $this->availabilityDate = $availabilityDate;

    }

    /**
     * Get the value of title
     *
     * @return  string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param   string  $title  
     *
     */
    public function setTitle($title): void
    {
        $this->title = $title;

    }

    /**
     * Get the value of rooms
     *
     * @return  int
     */
    public function getRooms(): int
    {
        return $this->rooms;
    }

    /**
     * Set the value of rooms
     *
     * @param   int $rooms  
     *
     */
    public function setRooms($rooms): void
    {
        $this->rooms = $rooms;

    }

    /**
     * Get the value of surface
     *
     * @return  int
     */
    public function getSurface(): int
    {
        return $this->surface;
    }

    /**
     * Set the value of surface
     *
     * @param   int  $surface  
     *
     */
    public function setSurface($surface): void
    {
        $this->surface = $surface;

    }

    /**
     * Get the value of description
     *
     * @return  string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param   string  $description  
     *
     */
    public function setDescription($description): void
    {
        $this->description = $description;

    }

    /**
     * Get the value of location
     *
     * @return  Location
     */
    public function getLocation(): Location
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @param   Location  $location  
     *
     */
    public function setLocationId(Location $location): void
    {
        $this->location = $location;

    }

    /**
     * Get the value of salesPrice
     *
     * @return  int|null
     */
    public function getSalesPrice(): ? int
    {
        return $this->salesPrice;
    }

    /**
     * Set the value of salesPrice
     *
     * @param   int  $salesPrice  
     *
     */
    public function setSalesPrice($salesPrice): void
    {
        $this->salesPrice = $salesPrice;

    }

    /**
     * Get the value of rent
     *
     * @return  int|null
     */
    public function getRent(): ? int
    {
        return $this->rent;
    }

    /**
     * Set the value of rent
     *
     * @param   int  $rent  
     *
     */
    public function setRent($rent): void
    {
        $this->rent = $rent;

    }

    

    /**
     * Get the value of rentCharge
     *
     * @return  int|null
     */
    public function getRentCharge(): ? int
    {
        return $this->rentCharge;
    }

    /**
     * Set the value of rentCharge
     *
     * @param   int  $rentCharge  
     *
     */
    public function setRentCharge($rentCharge): void
    {
        $this->rentCharge = $rentCharge;

    }

    /**
     * Get the value of charge
     *
     * @return  int|null
     */
    public function getCharge(): ? int
    {
        return $this->charge;
    }

    /**
     * Set the value of charge
     *
     * @param   int  $charge  
     *
     */
    public function setCharge($charge): void
    {
        $this->charge = $charge;

    }

    /**
     * Get the value of securityDeposit
     *
     * @return  int|null
     */
    public function getSecurityDeposit(): ? int
    {
        return $this->securityDeposit;
    }

    /**
     * Set the value of securityDeposit
     *
     * @param   int  $securityDeposit  
     *
     */
    public function setSecurityDeposit($securityDeposit): void
    {
        $this->securityDeposit = $securityDeposit;

    }

    /**
     * Get the value of agencyFees
     *
     * @return  int|null
     */
    public function getAgencyFees(): ? int
    {
        return $this->agencyFeesRent;
    }

    /**
     * Set the value of agencyFees
     *
     * @param   int  $agencyFees  
     *
     */
    public function setAgencyFees($agencyFeesRent): void
    {
        $this->agencyFeesRent = $agencyFeesRent;

    }

    /**
     * Get the value of energyDiagnostics
     *
     * @return  EnergyDiagnostics|null
     */
    public function getEnergyDiagnostics(): ? EnergyDiagnostics
    {
        return $this->energyDiagnostics;
    }

    /**
     * Set the value of energyDiagnostics
     *
     * @param   int  $energyDiagnostics  
     *
     */
    public function setEnergyDiagnostics($energyDiagnostics): void
    {
        $this->energyDiagnostics = $energyDiagnostics;

    }

        /**
     * Get the value of greenhouseGasEmissionIndices
     *
     * @return  GreenhouseGasEmissionIndices|null
     */
    public function getGreenhouseGasEmissionIndices(): ? GreenhouseGasEmissionIndices
    {
        return $this->greenhouseGasEmissionIndices;
    }

    /**
     * Set the value of greenhouseGasEmissionIndices
     *
     * @param   int  $greenhouseGasEmissionIndices  
     *
     */
    public function setGreenhouseGasEmissionIndices($greenhouseGasEmissionIndices): void
    {
        $this->greenhouseGasEmissionIndices = $greenhouseGasEmissionIndices;

    }

    /**
     * Get the value of owner
     *
     * @return  User
     */
    public function getOwner(): ? User
    {
        return $this->owner;
    }

    /**
     * Set the value of owner
     *
     * @param   User  $owner  
     *
     */
    public function setOwner($owner): void
    {
        $this->owner = $owner;

    }

    /**
     * Get the value of tenant
     *
     * @return  User|null
     */
    public function getTenant(): ? User
    {
        return $this->tenant;
    }

    /**
     * Set the value of tenant
     *
     * @param   User  $tenant  
     *
     */
    public function setTenant($tenant): void
    {
        $this->tenant = $tenant;

    }

    /**
     * Get the value of rentalManagement
     *
     * @return  RentalManagement|null
     */
    public function getRentalManagement(): ? RentalManagement
    {
        return $this->rentalManagement;
    }

    /**
     * Set the value of rentalManagement
     *
     * @param   RentalManagement  $rentalManagement  
     *
     */
    public function setRentalManagement($rentalManagement): void
    {
        $this->rentalManagement = $rentalManagement;

    }

    /**
     * Get the value of medias
     *
     * @return  array
     */
    public function getMedias(): array
    {
        return $this->medias;
    }

    /**
     * Set the value of medias
     *
     * @param   array  $medias  
     *
     */
    public function setMedias(array $medias): void
    {
        $this->medias = $medias;

    }

    /**
     * Get the value of propertyFeatures
     *
     * @return  array
     */
    public function getPropertyFeatures(): array
    {
        return $this->propertyFeatures;
    }

    /**
     * Set the value of propertyFeatures
     *
     * @param   array  $propertyFeatures  
     *
     */
    public function setPropertyFeatures(array $propertyFeatures): void
    {
        $this->propertyFeatures = $propertyFeatures;

    }
}