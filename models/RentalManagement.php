<?php


class RentalManagement
{
    private ? int $id = null;

    public function __construct(private string $management)
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
     * Get the value of management
     *
     * @return  string
     */
    public function getManagement(): string
    {
        return $this->management;
    }

    /**
     * Set the value of management
     *
     * @param   string  $management  
     *
     */
    public function setManagement($management): void
    {
        $this->management = $management;

    }
}