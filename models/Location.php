<?php


class Location
{
    private ? int $id = null;
    private ? int $district = null;

    public function __construct(private string $city)
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
     * Get the value of city
     *
     * @return  string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @param   string  $city  
     *
     */
    public function setCity($city): void
    {
        $this->city = $city;

    }

    /**
     * Get the value of district
     *
     * @return  int|null
     */
    public function getDistrict(): ?int
    {
        return $this->district;
    }

    /**
     * Set the value of district
     *
     * @param   int  $district  
     *
     */
    public function setDistrict($district): void
    {
        $this->district = $district;

    }
}