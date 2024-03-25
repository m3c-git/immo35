<?php

class LocationManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll() : ? array
    {
        $query = $this->db->prepare('SELECT * FROM location');
        
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $allLocation = [];

        if($results !== null)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new Location($result["city"]);
                    $value->setId($result["id"]);
                    $value->setDistrict($result["district"]);

                    $allLocation[] = $value;
                }
                
            }
            //dump($results);
            return $allLocation;
            
        }

    }


}