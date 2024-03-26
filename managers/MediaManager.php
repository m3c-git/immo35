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

    public function findByIdProperty(int $id) : ? array
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


    public function addMedia(Media $media) : void
    {

        /* Lors du INSERT à ne pas mettre les colonne entre double quote ou quote simple.
        N pas mettre les valeurs du VALUE entre backquote*/
        $query = $this->db->prepare('INSERT INTO medias (id, url, property_id, type) VALUES (NULL, :url, :property_id, :type)');

        $parameters = [
            'url' => $media->getUrl(),
            'property_id' => $media->getPropertyId(),
            'type' => $media->getType(),
            ];
        $query->execute($parameters);
    }

    public function updateMedia(Media $media) : void
    {
        $type = "vignette";

        /* Lors du INSERT à ne pas mettre les colonne entre double quote ou quote simple.
        N pas mettre les valeurs du VALUE entre backquote*/
        $query = $this->db->prepare("UPDATE medias SET type = :type WHERE id = :id");
           $parameters = [
               'id' => $media->getId(),
               'type' => $type,
               ];
           $query->execute($parameters);
    }
    
    public function deleteMedia(Media $media) : void
    {
    
        $query = $this->db->prepare('DELETE FROM medias WHERE url = :url');
        $parameters = [
            "url" => $media->getUrl(),
        ];
        $query->execute($parameters);
    
    }


}