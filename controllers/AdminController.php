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
        if(isset($_SESSION["role"]) && ($_SESSION["role"] === "ADMIN"  || $_SESSION["role"] === "READER"))
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
        if(isset($_SESSION["role"]) && ($_SESSION["role"] === "ADMIN"  || $_SESSION["role"] === "READER"))
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

        if(isset($_SESSION["role"]) && ($_SESSION["role"] === "ADMIN"  || $_SESSION["role"] === "READER"))
        {
        


                $um = new UserManager();
                $usersByRolerole = $um->findByRole($_GET["role"]);

                if($usersByRolerole !== null)
                {

                    unset($_SESSION["message"]);
                    $this->render("admin-users-by-role.html.twig", ["usersByRolerole" =>$usersByRolerole, "usersRole" => $_GET["role"]]);
                    
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
        if(isset($_SESSION["role"]) && ($_SESSION["role"] === "ADMIN"  || $_SESSION["role"] === "READER"))
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
                if(isset($_SESSION["role"]) && $_SESSION["role"] === "ADMIN")
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
        if(isset($_SESSION["role"]) && ($_SESSION["role"] === "ADMIN"  || $_SESSION["role"] === "READER"))
        {
            $um = new UserManager();
            $userById = $um->findOne($_GET["id"]);

            unset($_SESSION["message"]);
            unset($_SESSION["error-message"]);
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
                
                if(isset($_POST))
                {

                    if(!empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["email"]))
                    {
                        $um = new UserManager();
                        $userId = intval($_POST['userId']);
                        $user = $um->findOne($userId);
                        $userUpdate = $um->findByEmail($_POST["email"]);
                        
                        if($_POST["email"] !== $user->getEmail())
                        {
                            
                            if( $userUpdate === null)   
                            { 
                                $newEmail = htmlspecialchars($_POST["email"]);
                            }
                            else
                            {
                                $_SESSION["error-message"] = "Cette email est déjà utilé par un autre utilisateur";
                                $this->redirect("index.php?route=update-user&id=" . $userId);
                                //dump($_SESSION);
                            } 
                        }
                        else
                        {
                            $newEmail = htmlspecialchars($_POST["email"]);
                        }

                        $userId = intval($_POST['userId']) ;
                        $firstName = $this->CheckInput($_POST['firstName']);
                        $lastName = $this->CheckInput($_POST['lastName']);
                        $address = $this->CheckInput($_POST['address']);
                        $phone = $this->CheckInput($_POST['phone']);
                        $password = NULL;
                        $role = $this->CheckInput($_POST['role']); 
                        $user = new User($firstName, $lastName,  $address, $phone, $newEmail, $password, $role);
                        $user->setId($userId);
                        $um->updateUser($user);

                        $_SESSION["role"] = "ADMIN";

                        
                        $_SESSION["message"] = "Mise à jour de l'utilisateur effectuée avec succès";
                        unset($_SESSION["error-message"]);
                        $this->redirect("index.php?route=update-user&id=" . $userId);
                        //dump($_SESSION);
                    }
                    else
                    {   
                        $_SESSION["error-message"] = "Les champs Prénom, Nom et Email doivent être renseigné";
                        $this->redirect("index.php?route=update-user&id=" . $_POST['userId']);
                        //dump($_SESSION);
                    }

                }
                else
                {
                    $_SESSION["error-message"] = "Une erreur est survenue";
                    $this->redirect("index.php?route=users-user&role=admin");
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
        if(isset($_SESSION["role"]) && $_SESSION["role"] === "ADMIN")
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
            //dump($_SESSION);
        }

        
    }

     /******* Partie Admin des propriétés *******/

    public function adminPropertyType() : void
    {
        if(isset($_SESSION["role"]) && ($_SESSION["role"] === "ADMIN"  || $_SESSION["role"] === "READER"))
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

        if(isset($_SESSION["role"]) && ($_SESSION["role"] === "ADMIN"  || $_SESSION["role"] === "READER"))
        { 

            $pm = new PropertyManager();
            $propertysByType = $pm->findByType($_GET["type"]);

            $mm = new MediaManager();
            $mediasByType = $mm->findByTypeMedia($_GET["typeMedia"]);

            if($propertysByType !== null)
            {
                $propertys = [];  
                
                   
                foreach($propertysByType as $property)
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

                unset($_SESSION["message"]);
                $this->render("admin-propertys-by-type.html.twig", ["propertys" => $propertys, "type" => $_GET["type"]]);
                
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
        if(isset($_SESSION["role"]) && ($_SESSION["role"] === "ADMIN"  || $_SESSION["role"] === "READER"))
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

            $lm = new LocationManager();
            $allLocation = $lm->findAll();
            

            $this->render("add-property.html.twig", ["allFeatures" => $allFeatures,
                                                    "usersProprietaire" => $usersProprietaire, 
                                                    "usersLocataire" => $usersLocataire,
                                                    "allNoteEnergy" => $allNoteEnergy,
                                                    "allNoteGreenhouse" => $allNoteGreenhouse,
                                                    "allManagement" => $allManagement,
                                                    "allStatus" => $allStatus,
                                                    "allState" => $allState,
                                                    "allType" => $allType,
                                                    "allLocation" => $allLocation
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
                //gestion des caracterisque du bien

                $pm = new PropertyManager();

                $pfm = new PropertyFeaturesManager();
                $allFeatures = $pfm->findAll();

                $mm = new MediaManager();
    
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

                $lm = new LocationManager();
                $allLocation = $lm->findAll();

                if(isset($_POST) && isset($_FILES))
                {
                  
                    //dump($_POST);
                   

                    $ownerId = (int) $this->checkInput($_POST["ownerId"]);
                    $featuresId = [];
                    $salesPrice = (int) $this->checkInput($_POST["salesPrice"]);
                    $rent = (int) $this->checkInput($_POST["rent"]);
                    $charge = (int) $this->checkInput($_POST["charge"]);
                    $securityDeposit = (int) $this->checkInput($_POST["securityDeposit"]);
                    $rentCharge = (int)$this->checkInput($_POST["rentCharge"]);
                    $agencyFeesRent = (int) $this->checkInput($_POST["agencyFeesRent"]);
                    $energyDiagnosticsId = (int) $this->checkInput($_POST["energyDiagnosticsId"]);
                    $greenhouseGasEmissionIndicesId = (int) $this->checkInput($_POST["greenhouseGasEmissionIndicesId"]);
                    $statusId = (int) $this->checkInput($_POST["statusId"]);
                    $stateId = (int) $this->checkInput($_POST["stateId"]);
                    $typeId = (int) $this->checkInput($_POST["typeId"]);
                    $availabilityDate = $this->checkInput($_POST["availabilityDate"]);
                    $title = $this->checkInput($_POST["title"]);
                    $rooms = (int) $this->checkInput($_POST["rooms"]);
                    $surface = (int) $this->checkInput($_POST["surface"]);
                    $description = $this->checkInput($_POST["description"]);
                    $locationId = (int) $this->checkInput($_POST["city"]);
                    $rentalManagementId = (int) $this->checkInput($_POST["rentalManagementId"]);
            


                    if($this->checkInput($_POST["district"] !== ""))
                    {
                        $district = (int) $this->checkInput($_POST["district"]);
                    }
                    else
                    {
                        $district = $this->checkInput($_POST["district"]);

                    }

                    foreach($usersProprietaire as $proprietaire)
                    {
                        if($proprietaire->getId() === $ownerId)
                        { 
                            $ownerId = new User($proprietaire->getFirstName(), $proprietaire->getLastName(), $proprietaire->getAddress(),  $proprietaire->getPhone(), $proprietaire->getEmail(), null, $proprietaire->getRole());
                            $ownerId->setId($proprietaire->getId());
                        }
                    }

                    if($this->CheckInput($_POST['tenantId']) === "")
                    {
                     $tenantId = NULL;
                    }
                    else
                    {
                        $tenantId = (int) $this->CheckInput($_POST['tenantId']);   
                        
                        foreach($usersLocataire as $locataire)
                        {
                            if($locataire->getId() === $tenantId)
                            {
                            

                                $tenantId = new User($locataire->getFirstName(), $locataire->getLastName(), $locataire->getAddress(),  $locataire->getPhone(), $locataire->getEmail(), null, $locataire->getRole());
                                $tenantId->setId($locataire->getId());

                            }
                        }
                    
                    }

                    foreach($allNoteEnergy as $energy)
                    {
                        if($energy->getId() === $energyDiagnosticsId)
                        {
                            $energyDiagnosticsId = new EnergyDiagnostics($energy->getNote());
                            $energyDiagnosticsId->setId($energy->getId());
                        }
                    }

                    foreach($allNoteGreenhouse as $greenhouse)
                    {
                        if($greenhouse->getId() === $greenhouseGasEmissionIndicesId)
                        {
                            $greenhouseGasEmissionIndicesId = new GreenhouseGasEmissionIndices($greenhouse->getNote());
                            $greenhouseGasEmissionIndicesId->setId($greenhouse->getId());
                        }
                    }

                    foreach($allStatus as $status)
                    {
                        if($status->getId() === $statusId)
                        {
                            $statusId = new StatusProperty($status->getStatusName());
                            $statusId->setId($status->getId());
                        }
                    }

                    foreach($allState as $state)
                    {
                        if($state->getId() === $stateId)
                        {
                            $stateId = new State($state->getStateName());
                            $stateId->setId($state->getId());
                        }
                    }

                    foreach($allType as $type)
                    {
                        if($type->getId() === $typeId)
                        {
                            $typeId = new Type($type->getTypeName());
                            $typeId->setId($type->getId());
                        }
                    }

                    foreach($allManagement as $management)
                    {
                        if($management->getId() === $rentalManagementId)
                        {
                            $rentalManagementId = new RentalManagement($management->getManagement());
                            $rentalManagementId->setId($management->getId());
                        }
                    }

                    foreach($allLocation as $location)
                    {
                        if($location->getId() === $locationId)
                        {
                            $locationId = new Location($location->getCity());
                            $locationId->setId($location->getId());
                                
                            if($district !== "")
                            {
                               $locationId->setDistrict($location->getDistrict());
                                
                            }
                        }
                            
                    }   

                    $property = new Property($statusId, $stateId,  $typeId, $availabilityDate, $title, $rooms, $surface, $description, $locationId, $ownerId, $tenantId, $rentalManagementId);
                    $property->setSalesPrice($salesPrice);
                    $property->setRent($rent);
                    $property->setRentCharge($rentCharge);
                    $property->setCharge($charge);
                    $property->setSecurityDeposit($securityDeposit);
                    $property->setAgencyFeesRent($agencyFeesRent);
                    $property->setEnergyDiagnostics($energyDiagnosticsId);
                    $property->setGreenhouseGasEmissionIndices($greenhouseGasEmissionIndicesId);

                    $pm->createProperty($property);
                    $_SESSION["new-property-id"] = $property->getId();

                    //traitement des features après création du bien
                    foreach($allFeatures as $feature)
                        {
                            foreach($_POST["features"] as $id)
                            {
                                $featuresId = (int) $this->checkInput($id);
                                
                                if($feature->getId() === $featuresId)
                                {
                                    $pfm->updateFeatureProperty($property->getId(), $featuresId);
                                }
                                
                            }
                        }


                    //traitement des medias après création du bien
                    $upload = new Uploader();
                    $file_aray = $upload->reArrayFiles($_FILES['formFile']);
                    //dump($file_aray);

                

                    foreach($file_aray as $key => $file)
                    {
                        if($file['error'] === 1)
                        {
                            echo "Le fichier ne doit pas dépasser 2 Mo";

                        }
                        elseif(empty($file['name']))
                        {
                            echo "pas de fichier choisi<br>";

                        }
                        else
                        {
                            //dump($upload->rearrange($_FILES));
                            $newMedias = $upload->upload($file, $key);
                            $mm->addMedia($newMedias);
                            
                            echo "a garder<br>";

                                //$imageError = "Il y a eu une erreur lors de l'upload";

                        }
                        
                    }

                    unset($_SESSION["error-message"]);
                    $this->redirect("index.php?route=add-property");
                    //dump($_POST, $_FILES);
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
            $this->redirect("index.php?route=login");
            //dump($_SESSION);

        }

    }


    public function updateProperty() : void
    {
        if(isset($_SESSION["role"]) && ($_SESSION["role"] === "ADMIN"  || $_SESSION["role"] === "READER"))
        {
            $pm = new PropertyManager();
            $propertyById = $pm->findOne($_GET["id"]);

            if($propertyById !== null)
            {
              
            

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
                
                $this->render("update-property.html.twig", ["propertyById" => $propertyById, 
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
            else
            {
                //dump($_SESSION);
                $_SESSION["message"] = "Aucun biens correspondant";
                $this->redirect('index.php?route=admin-property-by-type&type=' . $_GET["type"] . '&typeMedia=vignette');
            }
            
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

                $pm = new PropertyManager();

                $pfm = new PropertyFeaturesManager();
                $featureByIdProperty = $pfm->findFeatureByIdProperty($_POST['propertyId']);
                
                $mm = new MediaManager();

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

                if(isset($_POST))
                {
                    $propertyId = intval($_POST['propertyId']) ;
                    $ownerId = (int) $this->checkInput($_POST["ownerId"]);
                    $featuresId = [];
                    //$salesPrice = (int) $this->checkInput($_POST["salesPrice"]);
                    //$rent = (int) $this->checkInput($_POST["rent"]);
                    //$charge = (int) $this->checkInput($_POST["charge"]);
                    //$securityDeposit = (int) $this->checkInput($_POST["securityDeposit"]);
                    //$rentCharge = (int)$this->checkInput($_POST["rentCharge"]);
                    //$agencyFeesRent = (int) $this->checkInput($_POST["agencyFeesRent"]);
                    $energyDiagnosticsId = (int) $this->checkInput($_POST["energyDiagnosticsId"]);
                    $greenhouseGasEmissionIndicesId = (int) $this->checkInput($_POST["greenhouseGasEmissionIndicesId"]);
                    $statusId = (int) $this->checkInput($_POST["statusId"]);
                    $stateId = (int) $this->checkInput($_POST["stateId"]);
                    $typeId = (int) $this->checkInput($_POST["typeId"]);
                    //$availabilityDate = $this->checkInput($_POST["availabilityDate"]);
                    $title = $this->checkInput($_POST["title"]);
                    $rooms = (int) $this->checkInput($_POST["rooms"]);
                    $surface = (int) $this->checkInput($_POST["surface"]);
                    $description = $this->checkInput($_POST["description"]);
                    $locationId = (int) $this->checkInput($_POST["city"]);
                    $rentalManagementId = (int) $this->checkInput($_POST["rentalManagementId"]);
            
                    if($this->CheckInput($_POST['availabilityDate']) === '')
                   {
                        $availabilityDate = NULL;
                   }
                   else
                   {
                        $availabilityDate = $this->CheckInput($_POST['availabilityDate']);
                   }
        
                   if($this->CheckInput($_POST['salesPrice']) === '')
                   {
                        $salesPrice = NULL;
                   }
                   else
                   {
                        $salesPrice = $this->CheckInput($_POST['salesPrice']);
        
                   }
        
                   if($this->CheckInput($_POST['rent']) === '')
                   {
                        $rent = NULL;
                   }
                   else
                   {
                        $rent = $this->CheckInput($_POST['rent']);
        
                   }
        
                   if($this->CheckInput($_POST['rentCharge']) === '')
                   {
                        $rentCharge = NULL;
                   }
                   else
                   {
                        $rentCharge = $this->CheckInput($_POST['rentCharge']);
                   }
        
                   if($this->CheckInput($_POST['charge']) === '')
                   {
                        $charge = NULL;
                   }
                   else
                   {
                        $charge = $this->CheckInput($_POST['charge']);
                   }
        
                   if($this->CheckInput($_POST['securityDeposit']) === '')
                   {
                        $securityDeposit = NULL;
                   }
                   else
                   {
                        $securityDeposit = $this->CheckInput($_POST['securityDeposit']);
                   }
        
                   if($this->CheckInput($_POST['agencyFeesRent']) === '')
                   {
                        $agencyFeesRent = NULL;
                   }
                   else
                   {
                        $agencyFeesRent = $this->CheckInput($_POST['agencyFeesRent']);
                   }


                    foreach($usersProprietaire as $proprietaire)
                    {
                        if($proprietaire->getId() === $ownerId)
                        { 
                            $ownerId = new User($proprietaire->getFirstName(), $proprietaire->getLastName(), $proprietaire->getAddress(),  $proprietaire->getPhone(), $proprietaire->getEmail(), null, $proprietaire->getRole());
                            $ownerId->setId($proprietaire->getId());
                        }
                    }

                    if($this->CheckInput($_POST['tenantId']) === "")
                    {
                     $tenantId = NULL;
                    }
                    else
                    {
                        $tenantId = (int) $this->CheckInput($_POST['tenantId']);   
                        
                        foreach($usersLocataire as $locataire)
                        {
                            if($locataire->getId() === $tenantId)
                            {
                            

                                $tenantId = new User($locataire->getFirstName(), $locataire->getLastName(), $locataire->getAddress(),  $locataire->getPhone(), $locataire->getEmail(), null, $locataire->getRole());
                                $tenantId->setId($locataire->getId());

                            }
                        }
                    
                    }

                    if($this->CheckInput($_POST['energyDiagnosticsId']) === '')
                    {
                        $energyDiagnosticsId = NULL;
                    }
                    else
                    {
                        foreach($allNoteEnergy as $energy)
                        {
                            if($energy->getId() === $energyDiagnosticsId)
                            {
                                $energyDiagnosticsId = new EnergyDiagnostics($energy->getNote());
                                $energyDiagnosticsId->setId($energy->getId());
                            }
                        }
                    }

                    

                    foreach($allNoteGreenhouse as $greenhouse)
                    {
                        if($greenhouse->getId() === $greenhouseGasEmissionIndicesId)
                        {
                            $greenhouseGasEmissionIndicesId = new GreenhouseGasEmissionIndices($greenhouse->getNote());
                            $greenhouseGasEmissionIndicesId->setId($greenhouse->getId());
                        }
                    }

                    foreach($allStatus as $status)
                    {
                        if($status->getId() === $statusId)
                        {
                            $statusId = new StatusProperty($status->getStatusName());
                            $statusId->setId($status->getId());
                        }
                    }

                    foreach($allState as $state)
                    {
                        if($state->getId() === $stateId)
                        {
                            $stateId = new State($state->getStateName());
                            $stateId->setId($state->getId());
                        }
                    }

                    foreach($allType as $type)
                    {
                        if($type->getId() === $typeId)
                        {
                            $typeId = new Type($type->getTypeName());
                            $typeId->setId($type->getId());
                        }
                    }

                    foreach($allManagement as $management)
                    {
                        if($management->getId() === $rentalManagementId)
                        {
                            $rentalManagementId = new RentalManagement($management->getManagement());
                            $rentalManagementId->setId($management->getId());
                        }
                    }

                    if($this->checkInput($_POST["district"] !== ""))
                    {
                        $district = (int) $this->checkInput($_POST["district"]);
                    }
                    else
                    {
                        $district = $this->checkInput($_POST["district"]);

                    }

                    foreach($allLocation as $location)
                    {
                        if($location->getId() === $locationId)
                        {
                            $locationId = new Location($location->getCity());
                            $locationId->setId($location->getId());
                                
                            if($district !== "")
                            {
                               $locationId->setDistrict($location->getDistrict());
                                
                            }
                        }
                            
                    }   
                    $property = new Property($statusId, $stateId,  $typeId, $availabilityDate, $title, $rooms, $surface, $description, $locationId, $ownerId, $tenantId, $rentalManagementId);
                    $property->setId($propertyId);
                    $property->setSalesPrice($salesPrice);
                    $property->setRent($rent);
                    $property->setRentCharge($rentCharge);
                    $property->setCharge($charge);
                    $property->setSecurityDeposit($securityDeposit);
                    $property->setAgencyFeesRent($agencyFeesRent);
                    $property->setEnergyDiagnostics($energyDiagnosticsId);
                    $property->setGreenhouseGasEmissionIndices($greenhouseGasEmissionIndicesId);

                    $pm->updateProperty($property);
                    $_SESSION["new-property-id"] = $property->getId();
        
                }

                //traitement des features après update du bien

                $featureProperty = [];

                if($featureByIdProperty !== null)
                {
                    foreach($featureByIdProperty as $feature)
                    {
                        $featureProperty[] = (int) $feature->getId();
                    }
                }
                
                // Features existantes
                if(isset($_POST["features"]))
                {
                    foreach($_POST["features"] as $postFeature)
                    {
                        $postFeatureProperty[] = (int) $postFeature;
                    }
                    

                    foreach($featureProperty as $feature)
                    {
                        if (!in_array($feature, $postFeatureProperty, true)) 
                        {
                            $pfm->deleteFeatureProperty($_POST["propertyId"], $feature);
                        }    
                        
                    }
                }
                else
                {
                    foreach($featureProperty as $feature)
                    {
                        $pfm->deleteFeatureProperty($_POST["propertyId"], $feature);
                    }
                }

                // Nouvelles features
                if(isset($_POST["newFeatures"]))
                {
                    $newfeatures = [];

                    foreach($_POST["newFeatures"] as $newfeature)
                    {
                        $newfeatures[] = (int) $newfeature;
                    }
                    
                    foreach($newfeatures as $newfeature)
                    {   
                        if (!in_array($newfeature, $featureProperty, true))
                        {
                            $pfm->updateFeatureProperty($_POST["propertyId"], $newfeature);
                        }
                    }
                }
                
                //gestion des medias après update du bien
                $oldMedias = $mm->findByIdProperty($_POST['propertyId']);
                
                // Medias existants
                if(isset($_POST["medias"]))
                {
                    foreach($oldMedias as $media)
                    {
                        if (in_array($media->getUrl(), $_POST["medias"], true))
                        {
                            $mm->deleteMedia($media);
                        }
                    }
                }
                /* else
                {
                    foreach($oldMedias as $media)
                    {
                        $mm->deleteMedia($media);
                    }
                } */

                if(isset($_FILES))
                {
                    $upload = new Uploader();
                    $file_aray = $upload->reArrayFiles($_FILES['formFile']);

                    foreach($file_aray as $key => $file)
                    {//dump($file);
                        
                            $newMedias = $upload->upload($file, $key);
                            
                            if($file['error'] === 1)
                            {
                                echo "Le fichier ne doit pas dépasser 2 Mo";

                            }
                            elseif(empty($file['name']))
                            {
                                echo "pas de fichier choisi<br>";

                            }
                            elseif($oldMedias === [])
                            {
                                $mm->addMedia($newMedias);
                            }
                            elseif($oldMedias !== null)
                            {
                                foreach($oldMedias as $media)
                                {
                                    if($file['name'] === $media->getUrl())
                                    {
                                        echo "déja utilisé<br>";  
                                    }                                   
                                }
                                $mm->addMedia($newMedias);
                            }
                        
                    }
                    
                }


                unset($_SESSION["message"]);
                $this->redirect("index.php?route=update-property&id=".$_POST['propertyId']);
                //dump($_SESSION);
                //dump($_POST, $_FILES);
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

    public function deleteProperty() : void
    {
        if(isset($_SESSION["role"]) && ($_SESSION["role"] === "ADMIN"  || $_SESSION["role"] === "READER"))
        {
                
                $pm = new PropertyManager();
                $propertyById = $pm->findOne($_GET["id"]);
                
                if($propertyById !== null)
                {
                    $this->render("delete-property.html.twig", ["propertyById" => $propertyById]);
                }
                else
                {
                    $this->redirect('index.php?route=admin-property-by-type&type=' . $_GET["type"] . '&typeMedia=vignette');
                    //dump($_POST);
                }
                
            
            

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé à se connecter";
            $this->redirect("index.php?route=login");
            //dump($_SESSION);
        }

        
    }

    public function checkDeleteProperty() : void
    {
        if(isset($_SESSION["role"]) && $_SESSION["role"] === "ADMIN")
        {
            if(isset($_POST))
            {
                $mm = new MediaManager();
                $mediaByIdProperty = $mm->findByIdProperty($_POST["propertyId"]);

                $pfm = new PropertyFeaturesManager();
                $featureByIdProperty = $pfm->findFeatureByIdProperty($_POST["propertyId"]);
                
                $pm = new PropertyManager();
                
                if($featureByIdProperty !== null)
                {
                    foreach($featureByIdProperty as $feature)
                    {
                        $pfm->deleteFeatureProperty($_POST["propertyId"], $feature->getId());
                    }
                }
                
                if($mediaByIdProperty !== [])
                {
                    foreach($mediaByIdProperty as $media)
                    {//dump($media->getUrl());
                        // Suppression du fichier image en locale
                        $file = "upload/". $media->getUrl();

                        if( file_exists ( $file))
                        {
                        
                            unlink( $file );
                            
                        }
                        
                        // Suppression des innformations du media en BDD
                        $mm->deleteMedia($media);
                    
                    }
                }

                $pm->deleteProperty($_POST["propertyId"]);


                $this->redirect('index.php?route=admin-property-by-type&type=' . $_GET["type"] . '&typeMedia=vignette');
                //dump($_POST);
            }
            

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé à se connecter";
            $this->redirect("index.php?route=login");
            //dump($_SESSION);
        }
    }
}