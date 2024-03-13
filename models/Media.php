<?php


class Media
{
    private ? int $id = null;

    public function __construct(private string $url, private int $propertyId, private ? string $type)
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
     * Get the value of url
     *
     * @return  string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @param   string  $url  
     *
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;

    }


    /**
     * Get the value of propertyId
     *
     * @return  int
     */
    public function getPropertyId()
    {
        return $this->propertyId;
    }

    /**
     * Set the value of propertyId
     *
     * @param   int  $propertyId  
     *
     */
    public function setPropertyId(int $propertyId): void
    {
        $this->propertyId = $propertyId;

    }

    /**
     * Get the value of type
     *
     * @return  string|null
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param   string  $type  
     *
     */
    public function setType(string $type): void
    {
        $this->type = $type;

    }
}