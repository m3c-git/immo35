<?php


class State
{
    private ? int $id = null;

    public function __construct(private string $stateName)
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
     * Get the value of stateName
     *
     * @return  string
     */
    public function getStateName(): string
    {
        return $this->stateName;
    }

    /**
     * Set the value of stateName
     *
     * @param   string  $stateName  
     *
     */
    public function setStateName($stateName): void
    {
        $this->stateName = $stateName;

    }
}