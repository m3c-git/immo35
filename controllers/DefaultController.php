<?php

class DefaultController extends AbstractController
{
    public function home() : void
    { 

        $spm = new StatusPropertyManager();
        $allStatus = $spm->findAll();

        $lm = new LocationManager();
        $allLocation = $lm->findAll();

        $tm = new TypeManager();
        $allType = $tm->findAll();

        $this->render("home.html.twig", ["allStatus" => $allStatus,
                                          "allType" => $allType,
                                          "allLocation" => $allLocation

                                    ]);
    }

    public function research() : void
    { 
        $pm = new PropertyManager();
        $allPropertys = $pm->findAll();

        $mm = new MediaManager();
        $mediasByType = $mm->findByTypeMedia($_GET["typeMedia"]);

        $spm = new StatusPropertyManager();
        $allStatus = $spm->findAll();

        $lm = new LocationManager();
        $allLocation = $lm->findAll();

        $tm = new TypeManager();
        $allType = $tm->findAll();


        
        if(isset($_POST["status"]) && isset($_POST["type"]) && isset($_POST["location"]))
        {
            $status = $_POST["status"];
            $type = $_POST["type"];
            $location = $_POST["location"];
            $propertys = $pm->findByStatusAndTypeAndLocation($status, $type, $location);
            

        }
        elseif(isset($_POST["status"]) && isset($_POST["location"]))
        {
            $status = $_POST["status"];
            $location = $_POST["location"];
            $propertys = $pm->findByStatusAndLocation($status, $location);
            

        }
        elseif(isset($_POST["type"]) && isset($_POST["location"]))
        {
            $type = $_POST["type"];
            $location = $_POST["location"];
            $propertys = $pm->findByTypeAndLocation($type, $location);


        }
        elseif(isset($_POST["status"]) && isset($_POST["type"]))
        {
            $status = $_POST["status"];
            $type = $_POST["type"];
            $propertys = $pm->findByStatusAndType($status, $type);


        }
        elseif(isset($_POST["status"]))
        {
            $status = $_POST["status"];
            $propertys = $pm->findByStatus($status);

        }
        elseif(isset($_POST["type"]))
        {
            $type = $_POST["type"];
            $propertys = $pm->findByType($type);

        }
        elseif(isset($_POST["location"]))
        {
            $location = $_POST["location"];
            $propertys = $pm->findByLocation($location);

        }



        $propertysResearch = []; 

        if(isset($propertys) && $propertys !== null)
        {
            foreach($propertys as $property)
            {
                $val = "";
                
                foreach($mediasByType as $media)
                {
                    
                    if($property->getId() === $media->getPropertyId() && $media->getType() === "vignette")
                    {
                        $val= ["property" => $property, "vignette_url" => $media->getUrl()];
                    }
                    
                }                          
                if(!$val) 
                {
                    $val = ["property" => $property, "vignette_url" => "../assets/img/no-vignette.svg"];
                }
                $propertysResearch[] = $val;
            }
            
            if($propertysResearch ==! [])
            {
                unset($_SESSION["message"]);
                $this->render("result.html.twig", ["allStatus" => $allStatus,
                                                "allType" => $allType,
                                                "allLocation" => $allLocation,
                                                "propertysResearch" => $propertysResearch

                                            ]);
            }
            

        } 
        else
        {
            $info = "Aucun biens ne correspond à votre recherche";
            $this->render("result.html.twig", ["allStatus" => $allStatus,
                                            "allType" => $allType,
                                            "allLocation" => $allLocation,
                                            "propertysResearch" => $propertysResearch,
                                            "info" => $info

                                        ]);
            

        }
        
        
    }

    public function page404() : void
    {
        $this->render("404.html.twig", []);
    }
}