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
    private ? int $energyPerformanceId = null;


    public function __construct(private int $statusPropertyId, private int $stateId, private int $typesId, private $availabilityDate, private string $title, private int $rooms, private int $surface, private string $description, private int $locationId, private int $usersId, private int $rentalManagementId)
    {

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
     * Get the value of statusPropertyId
     *
     * @return  int
     */
    public function getStatusPropertyId(): int
    {
        return $this->statusPropertyId;
    }

    /**
     * Set the value of statusPropertyId
     *
     * @param   int  $statusPropertyId  
     *
     */
    public function setStatusPropertyId($statusPropertyId): void
    {
        $this->statusPropertyId = $statusPropertyId;

    }

    /**
     * Get the value of stateId
     *
     * @return  int
     */
    public function getStateId(): int
    {
        return $this->stateId;
    }

    /**
     * Set the value of stateId
     *
     * @param   int  $stateId  
     *
     */
    public function setStateId($stateId): void
    {
        $this->stateId = $stateId;

    }

    /**
     * Get the value of typesId
     *
     * @return  int
     */
    public function getTypesId(): int
    {
        return $this->typesId;
    }

    /**
     * Set the value of typesId
     *
     * @param   int  $typesId  
     *
     */
    public function setTypesId($typesId): void
    {
        $this->typesId = $typesId;

    }

    /**
     * Get the value of availabilityDate
     *
     * @return  DateTime
     */
    public function getAvailabilityDate(): DateTime
    {
        return $this->availabilityDate;
    }

    /**
     * Set the value of availabilityDate
     *
     * @param   DateTime  $availabilityDate  
     *
     */
    public function setAvailabilityDate($availabilityDate): void
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
     * Get the value of locationId
     *
     * @return  int
     */
    public function getLocationId(): int
    {
        return $this->locationId;
    }

    /**
     * Set the value of locationId
     *
     * @param   int  $locationId  
     *
     */
    public function setLocationId($locationId): void
    {
        $this->locationId = $locationId;

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
     * Get the value of energyPerformanceId
     *
     * @return  int|null
     */
    public function getEnergyPerformanceId(): ? int
    {
        return $this->energyPerformanceId;
    }

    /**
     * Set the value of energyPerformanceId
     *
     * @param   int  $energyPerformanceId  
     *
     */
    public function setEnergyPerformanceId($energyPerformanceId): void
    {
        $this->energyPerformanceId = $energyPerformanceId;

    }

    /**
     * Get the value of usersId
     *
     * @return  int|null
     */
    public function getUsersId(): ? int
    {
        return $this->usersId;
    }

    /**
     * Set the value of usersId
     *
     * @param   int  $usersId  
     *
     */
    public function setUsersId($usersId): void
    {
        $this->usersId = $usersId;

    }

    /**
     * Get the value of rentalManagementId
     *
     * @return  int|null
     */
    public function getRentalManagementId(): ? int
    {
        return $this->rentalManagementId;
    }

    /**
     * Set the value of rentalManagementId
     *
     * @param   int  $rentalManagementId  
     *
     */
    public function setRentalManagementId($rentalManagementId): void
    {
        $this->rentalManagementId = $rentalManagementId;

    }
}