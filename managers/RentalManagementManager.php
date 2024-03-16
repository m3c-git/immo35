<?php

class RentalManagementManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll() : ? array
    {
        $query = $this->db->prepare('SELECT * FROM rental_management');
        
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $allManagement = [];

        if($results !== null)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new RentalManagement($result["management"]);
                    $value->setId($result["id"]);
                    $allManagement[] = $value;
                }
                
            }
            //dump($results);
            return $allManagement;
            
        }

    }


}