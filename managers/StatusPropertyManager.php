<?php

class StatusPropertyManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll() : ? array
    {
        $query = $this->db->prepare('SELECT * FROM status_property');
        
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $allStatus = [];

        if($results !== null)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new StatusProperty($result["status_name"]);
                    $value->setId($result["id"]);
                    $allStatus[] = $value;
                }
                
            }
            //dump($results);
            return $allStatus;
            
        }

    }


}