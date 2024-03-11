<?php


class GreenhouseGasEmissionIndices
{ //
    private ? int $id = null;

    public function __construct(private string $note)
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
     * Get the value of note
     *
     * @return  string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @param   string  $note  
     *
     */
    public function setNote($note): void
    {
        $this->note = $note;

    }

}