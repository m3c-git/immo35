<?php


class StatusProperty
{
    private ? int $id = null;

    public function __construct(private string $statusName)
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
     * Get the value of statusName
     *
     * @return  string
     */
    public function getStatusName(): string
    {
        return $this->statusName;
    }

    /**
     * Set the value of statusName
     *
     * @param   string  $statusName  
     *
     */
    public function setStatusName($statusName): void
    {
        $this->statusName = $statusName;

    }
}