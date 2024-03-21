<?php

class PropertyFeaturesManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
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

    /* public function findAllExceptId(int $id) : ? array
    {
        $query = $this->db->prepare('SELECT property_features.* FROM property_features JOIN property_link_features
        ON property_features.id = property_link_features.property_features_id 
        JOIN propertys ON propertys.id = property_link_features.property_id WHERE NOT property_link_features.property_id  = :id');
        
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

    } */

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
            
            
            return $features;
            
        }
        return null;

    }
    

    public function updateFeatureProperty(int $propertyId, int $newfeatureId) : void
    {
        /* Lors du INSERT à ne pas mettre les colonne entre double quote ou quote simple.
        N pas mettre les valeurs du VALUE entre backquote*/
        $query = $this->db->prepare('INSERT INTO property_link_features (id, property_features_id, property_id) VALUES (NULL, :property_features_id, :id)');

        $parameters = [
            'id' => $propertyId,
            'property_features_id' => $newfeatureId,
            ];
        $query->execute($parameters);
    }


    public function deleteFeatureProperty(int $propertyId, int $featureId) : void
    {
        $query = $this->db->prepare('DELETE FROM property_link_features WHERE property_id = :id AND property_features_id = :featureId');
        $parameters = [
            "id" => $propertyId,
            "featureId" => $featureId,
        ];
        $query->execute($parameters);
    
    }
 
    



}

