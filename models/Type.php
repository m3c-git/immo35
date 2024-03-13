<?php


class Type
{
    private ? int $id = null;
    private ? string $media = null;

    public function __construct(private string $typeName)
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
     * Get the value of typeName
     *
     * @return  string
     */
    public function getTypeName(): string
    {
        return $this->typeName;
    }

    /**
     * Set the value of typeName
     *
     * @param   string  $typeName  
     *
     */
    public function setTypeName($typeName): void
    {
        $this->typeName = $typeName;

    }

    /**
     * Get the value of media
     *
     * @return  string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set the value of media
     *
     * @param   string  $media  
     *
     */
    public function setMedia($media): void
    {
        $this->media = $media;

    }
}