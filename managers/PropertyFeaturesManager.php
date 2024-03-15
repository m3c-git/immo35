<?php

class PropertyFeaturesManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findFeatureByIdProperty($id) : ? array
    {
        $query = $this->db->prepare('SELECT property_features.* FROM property_features JOIN property_link_features
        ON property_features.id = property_link_features.property_features_id 
        JOIN propertys ON propertys.id = property_link_features.property_id WHERE property_link_features.property_id = :id');
        
        $parameters = [
            "id" => $id,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $features = [];

        if($results)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new PropertyFeatures($result["property_features_name"]);
                    $value->setId($result["id"]);
                    $features[] = $value;
                }
                
            }
            
            //dump($features);
            return $features;
            
        }

    }

    public function findAll() : ? array
    {
        $query = $this->db->prepare('SELECT * FROM property_features');
        
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $allfeatures = [];

        if($results !== null)
        {   foreach($results as $result)
            {   
                
                if($result !== null)
                {
                    $value = new PropertyFeatures($result["property_features_name"]);
                    $value->setId($result["id"]);
                    $allfeatures[] = $value;
                }
                
            }
            //dump($results);
            return $allfeatures;
            
        }

    }


}