<?php

class StateManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll() : ? array
    {
        $query = $this->db->prepare('SELECT * FROM states');
        
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $allMState = [];

        if($results !== null)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new State($result["state_name"]);
                    $value->setId($result["id"]);
                    $allMState[] = $value;
                }
                
            }
            //dump($results);
            return $allMState;
            
        }

    }


}