<?php

class EnergyDiagnosticsManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll() : ? array
    {
        $query = $this->db->prepare('SELECT * FROM energy_diagnostics');
        
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $allNotes = [];

        if($results !== null)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new EnergyDiagnostics($result["note_energy_diagnostics"]);
                    $value->setId($result["id"]);
                    $allNotes[] = $value;
                }
                
            }
            //dump($results);
            return $allNotes;
            
        }

    }


}