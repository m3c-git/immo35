<?php

class TypeManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll() : ? array
    {
        $query = $this->db->prepare('SELECT * FROM types');
        
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $allType = [];

        if($results !== null)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new Type($result["type_name"]);
                    $value->setId($result["id"]);
                    $allType[] = $value;
                }
                
            }
            //dump($results);
            return $allType;
            
        }

    }


}