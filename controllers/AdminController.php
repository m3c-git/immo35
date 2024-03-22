<?php

class AdminController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    /******* Partie Admin *******/

    public function admin() : void
    {
        if($_SESSION["role"] === "ADMIN")
        {
            $adminManage = ["Gestion des biens", "Gestion des utilisateurs", "Administration"];
            $this->render("home-admin.html.twig", ["adminManage" => $adminManage]);

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé à se connecter";
            $this->redirect("index.php?route=login");
        }
    
    
    }

    /******* Partie Admin des utilisateurs *******/

    public function adminUsersRole() : void
    {
        if($_SESSION["role"] === "ADMIN")
        {
            
            $this->render("admin-users-role.html.twig", []);

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé à se connecter";
            $this->redirect("index.php?route=login");
        }
    
    
    }

    public function adminUsersByRole() : void
    {

        if(isset($_SESSION["role"]) && $_SESSION["role"] === "ADMIN")
        {
            $tokenManager = new CSRFTokenManager();


                $um = new UserManager();
                $usersByRolerole = $um->findByRole($_GET["role"]);

                if($usersByRolerole !== null)
                {

                    unset($_SESSION["message"]);
                    $this->render("admin-users-by-role.html.twig", ["usersByRolerole" =>$usersByRolerole]);
                    
                }
                else
                {
                    $_SESSION["message"] = "Aucun utilasateurs trouvés";
                    $this->redirect("index.php?route=admin-users-role");
                    //dump($_GET);
                    //dump($_SESSION);


                }
            
        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé ";
            $this->redirect("index.php?route=login");
            //dump($_GET);
            //dump($_SESSION);
        }
    }

    public function addUser() : void
    {
        if($_SESSION["role"] === "ADMIN")
        {

            $this->render("add-user.html.twig", []);

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé à se connecter";
            $this->redirect("index.php?route=login");
        }

        

    }

    public function checkAddUser() : void
    {
        if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]))
        {
            $tokenManager = new CSRFTokenManager();
            if(isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"]))
            {
                if($_SESSION["role"] === "ADMIN")
                {
                    $um = new UserManager();
                    $user = $um->findByEmail($_POST["email"]);

                    if($user === null)
                    {
                        $firstName = htmlspecialchars($_POST["firstName"]);
                        $lastName = htmlspecialchars($_POST["lastName"]);
                        $address = htmlspecialchars($_POST["address"]);
                        $phone = htmlspecialchars($_POST["phone"]);
                        $email = htmlspecialchars($_POST["email"]);
                        $password = NULL;
                        $role = htmlspecialchars($_POST["role"]);
                        $user = new User($firstName, $lastName,  $address, $phone, $email, $password, $role);
                        
                        $um->createAdmin($user);

                        unset($_SESSION["error-message"]);

                       
                        $this->redirect("index.php?route=admin");
                    }
                    else
                    {
                        $_SESSION["error-message"] = "A user already exists with this email";
                        $this->redirect("index.php?route=add-user");
                    }
                    

                    


                }
                else
                {
                    $_SESSION["error-message"] = "Utilisateur non autorisé à se connecter";
                    $this->redirect("index.php?route=login");
                }
                        
                
            }
            else
            {
                $_SESSION["error-message"] = "Invalid CSRF token";
                $this->redirect("index.php?route=add-user.html.twig");
            }
        }
        else
        {   
            $_SESSION["error-message"] = "Missing fields";
            $this->redirect("index.php?route=add-user.html.twig");
        }
    }

    public function updateUser() : void
    {
        if($_SESSION["role"] === "ADMIN")
        {
            $um = new UserManager();
            $userById = $um->findOne($_GET["id"]);

            $this->render("update-user.html.twig", ["userById" =>$userById]);

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé à se connecter";
            $this->redirect("index.php?route=login");
        }

        
    }

    public function checkUpdateUser() : void
    {
        if(isset($_SESSION["role"]) && $_SESSION["role"] === "ADMIN")
        {
            $tokenManager = new CSRFTokenManager();

            if(isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"]))
            {

                $um = new UserManager();
                $userById = $um->updateUser($_POST['userId']);

                if($userById !== null)
                {
                unset($_SESSION["message"]);
                $this->redirect("index.php?route=admin");
                //dump($_SESSION);
                }
                else
                {
                    $_SESSION["message"] = "Aucun utilasateurs trouvés";
                    $this->redirect("index.php?route=admin");
                    //dump($_SESSION);

                }

            }
            else
            {
                $_SESSION["error-message"] = "Invalid CSRF token";
                $this->redirect("index.php?route=admin");
                //dump($_SESSION);


            }

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé ";
            $this->redirect("index.php?route=login");
            //dump($_SESSION);

        }

    }

    public function deleteUser() : void
    {
        if($_SESSION["role"] === "ADMIN")
        {
            $um = new UserManager();
            $userById = $um->deleteUser($_GET["id"]);
            $this->redirect("index.php?route=admin");
            //dump($_SESSION);

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé à se connecter";
            $this->redirect("index.php?route=login");
            dump($_SESSION);
        }

        
    }

     /******* Partie Admin des propriétés *******/

    public function adminPropertyType() : void
    {
        if($_SESSION["role"] === "ADMIN")
        {
        $um = new PropertyManager();
        $propertyType = $um->findTypes();

        $this->render("admin-property-type.html.twig", ["propertyType" => $propertyType]);

        }
        else
        {
        $_SESSION["error-message"] = "Utilisateur non autorisé à se connecter";
        $this->redirect("index.php?route=login");
        }
    
    
    }

    public function adminPropertysByType() : void
    {

        if(isset($_SESSION["role"]) && $_SESSION["role"] === "ADMIN")
        { 

            $pm = new PropertyManager();
            $propertysByType = $pm->findByType($_GET["type"]);

            $mm = new MediaManager();
            $mediasByType = $mm->findByTypeMedia($_GET["typeMedia"]);

            if($propertysByType !== null)
            {

                $propertys = [];  
                foreach($mediasByType as $media)
                {
                    foreach($propertysByType as $property)
                    {
                        
                        if($property->getId() === $media->getPropertyId())
                        {
                            
                            $propertys[]= ["property" => $property, "vignette_url" => $media->getUrl()];
                        }
                        elseif($media->getType() === null)
                        { 
                            $propertys[]= ["property" => $property, "vignette_url" => "../assets/img/no-vignette.svg"];dump($propertys);
                        }

                    }
                        
                }
        
                unset($_SESSION["message"]);
                $this->render("admin-propertys-by-type.html.twig", ["propertys" => $propertys]);
                
            }
            else
            {
                $_SESSION["message"] = "Aucun biens trouvés";
                $this->redirect("index.php?route=admin-property-type");
                //dump($propertysByType);
                //dump($_SESSION);


            }
                
        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé ";
            $this->redirect("index.php?route=login");
            //dump($_GET);
            //dump($_SESSION);
        }
    }

    
    public function addProperty() : void
    {
        if($_SESSION["role"] === "ADMIN")
        {

            $fm = new PropertyFeaturesManager();
            $allFeatures = $fm->findAll();

            $um = new UserManager();
            $usersProprietaire = $um->findByRole("Proprietaire");
            $usersLocataire = $um->findByRole("Locataire");

            $em = new EnergyDiagnosticsManager();
            $allNoteEnergy = $em->findAll();

            $gm = new GreenhouseGasEmissionIndicesManager();
            $allNoteGreenhouse = $gm->findAll();

            $rm = new RentalManagementManager();
            $allManagement = $rm->findAll();

            $spm = new StatusPropertyManager();
            $allStatus = $spm->findAll();

            $sm = new StateManager();
            $allState = $sm->findAll();

            $tm = new TypeManager();
            $allType = $tm->findAll();


            $this->render("add-property.html.twig", ["allFeatures" => $allFeatures,
                                                    "usersProprietaire" => $usersProprietaire, 
                                                    "usersLocataire" => $usersLocataire,
                                                    "allNoteEnergy" => $allNoteEnergy,
                                                    "allNoteGreenhouse" => $allNoteGreenhouse,
                                                    "allManagement" => $allManagement,
                                                    "allStatus" => $allStatus,
                                                    "allState" => $allState,
                                                    "allType" => $allType
                                                ]);

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé à se connecter";
            $this->redirect("index.php?route=login");
        }

    
    }

    public function checkAddProperty() : void
    {
        if(isset($_SESSION["role"]) && $_SESSION["role"] === "ADMIN")
        {
            $tokenManager = new CSRFTokenManager();

            if(isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"]))
            {
                /*gestion des caracterisque du bien*/

                $pm = new PropertyManager();

                $pfm = new PropertyFeaturesManager();
                $allFeatures = $pfm->findAll();
    
                $um = new UserManager();
                $usersProprietaire = $um->findByRole("Proprietaire");
                $usersLocataire = $um->findByRole("Locataire");
    
                $em = new EnergyDiagnosticsManager();
                $allNoteEnergy = $em->findAll();
    
                $gm = new GreenhouseGasEmissionIndicesManager();
                $allNoteGreenhouse = $gm->findAll();
    
                $rm = new RentalManagementManager();
                $allManagement = $rm->findAll();
    
                $spm = new StatusPropertyManager();
                $allStatus = $spm->findAll();
    
                $sm = new StateManager();
                $allState = $sm->findAll();
    
                $tm = new TypeManager();
                $allType = $tm->findAll();

                if(isset($_POST) && isset($_FILES))
                {

                    dump($_POST, $_FILES);

                    $ownerId = $this->checkInput($_POST["ownerId"]);
                    $tenantId = $this->checkInput($_POST["tenantId"]);
                    $featuresId = $this->checkInput($_POST["features"]);
                    $salesPrice = $this->checkInput($_POST["salesPrice"]);
                    $rent = $this->checkInput($_POST["rent"]);
                    $charge = $this->checkInput($_POST["charge"]);
                    $rentCharge = $this->checkInput($_POST["rentCharge"]);
                    $agencyFeesRent = $this->checkInput($_POST["agencyFeesRent"]);
                    $energyDiagnosticsId = $this->checkInput($_POST["energyDiagnosticsId"]);
                    $greenhouseGasEmissionIndicesId = $this->checkInput($_POST["greenhouseGasEmissionIndicesId"]);
                    $statusId = $this->checkInput($_POST["statusId"]);
                    $stateId = $this->checkInput($_POST["stateId"]);
                    $typeId = $this->checkInput($_POST["typeId"]);
                    $availabilityDate = $this->checkInput($_POST["role"]);
                    $title = $this->checkInput($_POST["title"]);
                    $rooms = $this->checkInput($_POST["rooms"]);
                    $surface = $this->checkInput($_POST["surface"]);
                    $description = $this->checkInput($_POST["description"]);
                    $city = $this->checkInput($_POST["city"]);
                    $district = $this->checkInput($_POST["district"]);
                    $rentalManagementId = $this->checkInput($_POST["rentalManagementId"]);
                    $location = $this->checkInput($_POST["location"]);

                    
                    foreach($usersProprietaire as $proprietaire)
                    {
                        if($proprietaire->getId() === $ownerId)
                        {
                            $ownerId = new User($proprietaire->getFirstName(), $proprietaire->getLastName(), $proprietaire->getAddress(),  $proprietaire->getPhone(), $proprietaire->getEmail(), null, $proprietaire->getRole());
                        }
                    }

                    foreach($usersLocataire as $locataire)
                    {
                        if($locataire->getId() === $tenantId)
                        {
                            $tenantId = new User($locataire->getFirstName(), $locataire->getLastName(), $locataire->getAddress(),  $locataire->getPhone(), $locataire->getEmail(), null, $locataire->getRole());
                        }
                    }

                    foreach($allNoteEnergy as $energy)
                    {
                        if($energy->getId() === $energyDiagnosticsId)
                        {
                            $energyDiagnosticsId = new EnergyDiagnostics($energy->getNote());
                        }
                    }

                    foreach($allManagement as $management)
                    {
                        if($management->getId() === $rentalManagementId)
                        {
                            $rentalManagementId = new RentalManagement($management->getManagement());
                        }
                    }

                    foreach($allNoteGreenhouse as $greenhouse)
                    {
                        if($greenhouse->getId() === $energyDiagnosticsId)
                        {
                            $energyDiagnosticsId = new RentalManagementManager($greenhouse->getNote());
                        }
                    }

                    foreach($allStatus as $status)
                    {
                        if($status->getId() === $statusId)
                        {
                            $statusId = new StatusProperty($status->getStatusName());
                        }
                    }

                    foreach($allState as $state)
                    {
                        if($state->getId() === $stateId)
                        {
                            $stateId = new State($status->getStateName());
                        }
                    }

                    foreach($allType as $type)
                    {
                        if($type->getId() === $typeId)
                        {
                            $typeId = new Type($type->getTypeName());
                        }
                    }

                    if($district === null)
                    {
                        $location = new Location($city);
                    }
                    else
                    {
                        $location = new Location($city);
                        $location->setDistrict($district);
                    }
                    

                    $property = new Property($statusId, $stateId,  $typeId, $availabilityDate, $title, $rooms, $surface, $description, $location, $ownerId, $ownerId, $rentalManagementId);
                    
                    $pm->createProperty($property);

                    //traiter features après création du bien
                    foreach($allFeatures as $feature)
                        {
                            foreach($_POST["features"] as $featureId)
                            {
                                if($feature->getId() === $featureId)
                                $featureId = $pfm->updateFeatureProperty($property->getId(), $featureId);
                            }
                        }


                    unset($_SESSION["error-message"]);
                    $this->redirect("index.php?route=add-property");
                }
                //dump($_SESSION);
                
            }
            else
            {
                $_SESSION["error-message"] = "Invalid CSRF token";
                $this->redirect("index.php?route=admin");
                //dump($_SESSION);
                

            }

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé ";
            //$this->redirect("index.php?route=login");
            dump($_SESSION);

        }

    }


    public function updateProperty() : void
    {
        if($_SESSION["role"] === "ADMIN")
        {
            $pm = new PropertyManager();
            $propertyById = $pm->findOne($_GET["id"]);

            $mm = new MediaManager();
            $mediaByIdProperty = $mm->findByIdProperty($_GET["id"]);
            $propertyById->setMedias($mediaByIdProperty);

            $fm = new PropertyFeaturesManager();
            $featureByIdProperty = $fm->findFeatureByIdProperty($_GET["id"]);
            $propertyById->setPropertyFeatures($featureByIdProperty);
            $allFeatures = $fm->findAll();

            $um = new UserManager();
            $usersProprietaire = $um->findByRole("Proprietaire");
            $usersLocataire = $um->findByRole("Locataire");

            $em = new EnergyDiagnosticsManager();
            $allNoteEnergy = $em->findAll();

            $gm = new GreenhouseGasEmissionIndicesManager();
            $allNoteGreenhouse = $gm->findAll();

            $rm = new RentalManagementManager();
            $allManagement = $rm->findAll();

            $spm = new StatusPropertyManager();
            $allStatus = $spm->findAll();

            $sm = new StateManager();
            $allState = $sm->findAll();

            $tm = new TypeManager();
            $allType = $tm->findAll();


            //dump($propertyById, $usersProprietaire, $usersLocataire, $_FILES);
            unset($_SESSION["message"]);
            
            $this->render("update-property.html.twig", ["propertyById" =>$propertyById, 
                                                        "allFeatures" => $allFeatures, 
                                                        "usersProprietaire" => $usersProprietaire, 
                                                        "usersLocataire" => $usersLocataire,
                                                        "allNoteEnergy" => $allNoteEnergy,
                                                        "allNoteGreenhouse" => $allNoteGreenhouse,
                                                        "allManagement" => $allManagement,
                                                        "allStatus" => $allStatus,
                                                        "allState" => $allState,
                                                        "allType" => $allType
                                                    ]);
            
        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé à se connecter";
            $this->redirect("index.php?route=login");
        }

        
    }

    public function checkUpdateProperty() : void
    {
        if(isset($_SESSION["role"]) && $_SESSION["role"] === "ADMIN")
        {
            $tokenManager = new CSRFTokenManager();

            if(isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"]))
            {
                /*gestion des caracterisque du bien*/

                $um = new PropertyManager();
                $property = $um->updateProperty($_POST['propertyId']);

                

                if(isset($_POST["features"]) && isset($_FILES))
                {
                    $mm = new MediaManager();
                    $pfm = new PropertyFeaturesManager();
                    $featureByIdProperty = $pfm->findFeatureByIdProperty($_POST['propertyId']);
                    
                    $allFeatureProperty = [];
                    $newfeatures = [];
                    foreach($_POST["features"] as $newfeature)
                    {
                        $newfeatures[] = (int) $newfeature;
                    }

                    foreach($featureByIdProperty as $feature)
                    {
                        $allFeatureProperty[] = (int) $feature->getId();
                    }
    
                    foreach($allFeatureProperty as $feature)
                    {
                        if (!in_array($feature, $newfeatures, true)) 
                        {
        
                            $pfm->deleteFeatureProperty($_POST["propertyId"], $feature);
                        }    
                        
                    }
                    
                    foreach($newfeatures as $newfeature)
                    {   
                        
                        
                        if (!in_array($newfeature, $allFeatureProperty, true))
                        {
                            $pfm->updateFeatureProperty($_POST["propertyId"], $newfeature);
                        }
                        
                    }

                    /*gestion des medias du bien*/
        
                    $upload = new Uploader();
                    $oldMedias = $mm->findByIdProperty($_POST['propertyId']);
                    $keys = array_keys($_FILES);

                    foreach($keys as $index => $key)
                    {//dump($_FILES[$key]);
                        if($_FILES[$key]['name'] === $oldMedias[$index]->getUrl())
                        {
                            echo "déja utilisé<br>";
                            
                        }
                        elseif($_FILES[$key]['error'] === 1)
                        {
                            echo "Le fichier ne doit pas dépasser 2 Mo";

                        }
                        elseif(empty($_FILES[$key]["name"]))
                        {
                            echo "pas de fichier choisi<br>";

                        }
                        else
                        {
                            $newMedias = $upload->upload($_FILES, $key);
                            $mm->addMedia($newMedias);
                            $mm->deleteMedia($oldMedias[$index]);
                            echo "a garder<br>";

                                //$imageError = "Il y a eu une erreur lors de l'upload";

                        }
                        
                    }
       
                }
                

                unset($_SESSION["message"]);
                $this->redirect("index.php?route=update-property&id=".$_POST['propertyId']);
                //dump($_SESSION);
                dump($_POST, $_FILES);
            }
            else
            {
                $_SESSION["error-message"] = "Invalid CSRF token";
                $this->redirect("index.php?route=admin");
                //dump($_SESSION);
                

            }

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé ";
            //$this->redirect("index.php?route=login");
            dump($_SESSION);

        }

    }

}