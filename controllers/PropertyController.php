<?php

class PropertyController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function showAllPropertys() : void
    {
        //$this->render("home.html.twig", []);
    }

    public function detailsProperty() : void
    {
      
        $pm = new PropertyManager();
        $propertyById = $pm->findOne($_GET["id"]);

        $mm = new MediaManager();
        $mediaByIdProperty = $mm->findByIdProperty($_GET["id"]);

        if($mediaByIdProperty !== [])
        {
            if($mediaByIdProperty[0]->gettype() === null)
            {
                $mm->updateMedia($mediaByIdProperty[0]);
            }
            $propertyById->setMedias($mediaByIdProperty);

        }

        $fm = new PropertyFeaturesManager();
        $featureByIdProperty = $fm->findFeatureByIdProperty($_GET["id"]);

        if($featureByIdProperty !== null)
        {
            $propertyById->setPropertyFeatures($featureByIdProperty);
        }
        
        $allFeatures = $fm->findAll();

        $um = new UserManager();
        $usersProprietaire = $um->findByRole("Proprietaire");
        $usersLocataire = $um->findByRole("Locataire");

        $em = new EnergyDiagnosticsManager();
        $allNoteEnergy = $em->findAll();

        $gm = new GreenhouseGasEmissionIndicesManager();
        $allNoteGreenhouse = $gm->findAll();

        $lm = new LocationManager();
        $allLocation = $lm->findAll();

        $rm = new RentalManagementManager();
        $allManagement = $rm->findAll();

        $spm = new StatusPropertyManager();
        $allStatus = $spm->findAll();

        $sm = new StateManager();
        $allState = $sm->findAll();

        $tm = new TypeManager();
        $allType = $tm->findAll();
       
        //dump($propertyById);
        //dump($propertyById, $usersProprietaire, $usersLocataire, $_FILES);
        unset($_SESSION["message"]);
        
        $this->render("details-property.html.twig", ["propertyById" => $propertyById, 
                                                    "allFeatures" => $allFeatures, 
                                                    "featureByIdProperty" => $featureByIdProperty,
                                                    "mediaByIdProperty" => $mediaByIdProperty,
                                                    "usersProprietaire" => $usersProprietaire, 
                                                    "allLocation" => $allLocation,
                                                    "usersLocataire" => $usersLocataire,
                                                    "allNoteEnergy" => $allNoteEnergy,
                                                    "allNoteGreenhouse" => $allNoteGreenhouse,
                                                    "allManagement" => $allManagement,
                                                    "allStatus" => $allStatus,
                                                    "allState" => $allState,
                                                    "allType" => $allType
                                                ]);

        
        


        

       
        
    }

    /******* Liste des biens en location ou en vente  *******/

    public function showPropertysByStatus() : void
    {
      
        $pm = new PropertyManager();
        $propertyStatus = $pm->findByStatus($_GET["status"]);

        $mm = new MediaManager();
        $mediasByType = $mm->findByTypeMedia($_GET["typeMedia"]);

        if($propertyStatus !== null)
        {
            $propertys = [];  

            foreach($propertyStatus as $property)
            {$val = "";
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
                $propertys[] = $val;
            }

            
            if($_GET["status"] === "A LOUER")
            {   unset($_SESSION["message"]);
                $this->render("rent.html.twig", ["propertys" => $propertys]);

            }
            elseif($_GET["status"] === "A VENDRE")
            {
                unset($_SESSION["message"]);
                $this->render("buy.html.twig", ["propertys" => $propertys]);

            }
        
        }
        else
        {
            $info = "Aucun biens trouvés";
            $this->render("buy.html.twig", ["info" => $info]);
            //dump($_SESSION["message"]);
        }

        
    }
    
    public function propertyDetails() : void
    {
        $pm = new PropertyManager();
            $propertyById = $pm->findOne($_GET["id"]);

            $mm = new MediaManager();
            $mediaByIdProperty = $mm->findByIdProperty($_GET["id"]);
            
            if($mediaByIdProperty !== [])
            {
                if($mediaByIdProperty[0]->gettype() === null)
                {
                    $mm->updateMedia($mediaByIdProperty[0]);
                }
                $propertyById->setMedias($mediaByIdProperty);

            }

            $fm = new PropertyFeaturesManager();
            $featureByIdProperty = $fm->findFeatureByIdProperty($_GET["id"]);

            if($featureByIdProperty !== null)
            {
                $propertyById->setPropertyFeatures($featureByIdProperty);
            }

            unset($_SESSION["message"]);
            
            $this->render("update-property.html.twig", ["propertyById" => $propertyById, 
                                                        "featureByIdProperty" => $featureByIdProperty,
                                                        "mediaByIdProperty" => $mediaByIdProperty,

                                                    ]);
    }

}
