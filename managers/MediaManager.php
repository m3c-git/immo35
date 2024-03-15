<?php

class MediaManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findByTypeMedia($type) : ? array
    {
        $query = $this->db->prepare('SELECT * FROM medias WHERE type = :type');
        
        $parameters = [
            "type" => $type,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $medias = [];

        if($results)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new Media($result["url"], $result["property_id"], $result["type"]);
                    $value->setId($result["id"]);
                    $medias[] = $value;
                }
                
            }
            //dump($medias);
            return $medias;
            
        }

    }

    public function findByIdProperty($id) : ? array
    {
        $query = $this->db->prepare('SELECT * FROM medias WHERE property_id = :id');
        
        $parameters = [
            "id" => $id,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $medias = [];

        if($results !== null)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new Media($result["url"], $result["property_id"], $result["type"]);
                    $value->setId($result["id"]);
                    $medias[] = $value;
                }
                
            }
            //dump($results);
            return $medias;
            
        }

    }


}