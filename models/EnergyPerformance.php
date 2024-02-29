<?php


class EnergyPerformance
{
    private ? int $id = null;

    public function __construct(private string $energyDiagnostics, private string $greenhouseGasEmissionIndices)
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
     * Get the value of energyDiagnostics
     *
     * @return  string
     */
    public function getEnergyDiagnostics(): string
    {
        return $this->energyDiagnostics;
    }

    /**
     * Set the value of energyDiagnostics
     *
     * @param   string  $energyDiagnostics  
     *
     */
    public function setEnergyDiagnostics($energyDiagnostics): void
    {
        $this->energyDiagnostics = $energyDiagnostics;

    }

    /**
     * Get the value of greenhouseGasEmissionIndices
     *
     * @return  string
     */
    public function getGreenhouseGasEmissionIndices(): string
    {
        return $this->greenhouseGasEmissionIndices;
    }

    /**
     * Set the value of greenhouseGasEmissionIndices
     *
     * @param   string  $greenhouseGasEmissionIndices  
     *
     */
    public function setGreenhouseGasEmissionIndices($greenhouseGasEmissionIndices): void
    {
        $this->greenhouseGasEmissionIndices = $greenhouseGasEmissionIndices;

    }
}