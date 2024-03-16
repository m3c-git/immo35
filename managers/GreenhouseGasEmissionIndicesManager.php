<?php

class GreenhouseGasEmissionIndicesManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll() : ? array
    {
        $query = $this->db->prepare('SELECT * FROM greenhouse_gas_emission_indices');
        
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $allNotes = [];

        if($results !== null)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new GreenhouseGasEmissionIndices($result["note_greenhouse_gas_emission_indices"]);
                    $value->setId($result["id"]);
                    $allNotes[] = $value;
                }
                
            }
            //dump($results);
            return $allNotes;
            
        }

    }


}