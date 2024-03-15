<?php

class AdminController extends AbstractController
{

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
                        $this->redirect("index.php?route=add-user.html.twig");
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
                        elseif(!$propertys)
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
 

    public function updateProperty() : void
    {
        if($_SESSION["role"] === "ADMIN")
        {
            $pm = new PropertyManager();
            $propertyById = $pm->findOne($_GET["id"]);

            $mm = new MediaManager();
            $mediaByIdProperty = $mm->findByIdProperty($_GET["id"]);
            $propertyById->setMedias($mediaByIdProperty);

            dump($propertyById, $_FILES);
            unset($_SESSION["message"]);
            
            $this->render("update-property.html.twig", ["propertyById" =>$propertyById]);
            
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
        {dump($_FILES);
            /* $tokenManager = new CSRFTokenManager();

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
            //dump($_SESSION); */

        }

    }

}