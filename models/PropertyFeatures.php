<?php


class PropertyFeatures
{
    private ? int $id = null;

    public function __construct(private string $propertyFeaturesName	)
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
     * Get the value of propertyFeaturesName
     *
     * @return  string
     */
    public function getPropertyFeaturesName(): string
    {
        return $this->propertyFeaturesName;
    }

    /**
     * Set the value of propertyFeaturesName
     *
     * @param   string  $propertyFeaturesName  
     *
     */
    public function setPropertyFeaturesName(string $propertyFeaturesName): void
    {
        $this->propertyFeaturesName = $propertyFeaturesName;

    }
}