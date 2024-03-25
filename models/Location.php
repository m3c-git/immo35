<?php


class Location
{
    private ? int $id = null;
    private ? string $district = null;

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
    public function setId(int $id): void
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
     * @return  string|null
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * Set the value of district
     *
     * @param   string  $district  
     *
     */
    public function setDistrict(string $district): void
    {
        $this->district = $district;

    }
}