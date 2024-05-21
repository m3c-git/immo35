<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class AuthController extends AbstractController
{
    public function login() : void
    {
        unset($_SESSION["message"]);
        unset($_SESSION["error-message"]);
        $this->render("login.html.twig", []);
    }

    public function checkLogin() : void
    {

        if(isset($_POST["email"]) && isset($_POST["password"]))
        {
            $tokenManager = new CSRFTokenManager();

            if(isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"]))
            {
                $um = new UserManager();
                $user = $um->findByEmail($_POST["email"]);

                if($user !== null)
                {
                    if(password_verify($_POST["password"], $user->getPassword()))
                    {
                        if($user->getRole() === "ADMIN" || $user->getRole() === "READER")
                        {
                            $_SESSION["role"] = $user->getRole();
                           
                            $_SESSION["user"] = $user->getId();

                            unset($_SESSION["error-message"]);

                            $this->redirect("index.php?route=admin");
                            //dump($_SESSION);
                        }
                        else
                        {
                            $_SESSION["error-message"] = "Utilisateur non autorisé à se connecter";
                            $this->redirect("index.php?route=login");
                        }
                        

                    }
                    else
                    {
                        $_SESSION["error-message"] = "Login ou mot de passe incorrect";
                        $this->redirect("index.php?route=login");
                    }
                }
                else
                {
                    $_SESSION["error-message"] = "Login ou mot de passe incorrect";
                    $this->redirect("index.php?route=login");
                }
            }
            else
            {
                $_SESSION["error-message"] = "Invalid CSRF token";
                $this->redirect("index.php?route=login");
            }
        }
        else
        {
            $_SESSION["error-message"] = "Missing fields";
            $this->redirect("index.php?route=login");
        }
    }

    public function register() : void
    {
        if(isset($_SESSION["role"]) && ($_SESSION["role"] === "ADMIN"  || $_SESSION["role"] === "READER"))
        {
            $this->render("register.html.twig", []);

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé.";
            $this->redirect("index.php?route=login");
        }
        
    }

    public function checkRegister() : void
    {
        if(isset($_SESSION["role"]) && $_SESSION["role"] === "ADMIN")
        {
            if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"])
            && isset($_POST["password"]) && isset($_POST["confirm-password"]))
            {
                $tokenManager = new CSRFTokenManager();
                if(isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"]))
                {
                    if($_POST["password"] === $_POST["confirm-password"])
                    {
                        $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9\s]).{8,}$/';

                        if (preg_match($password_pattern, trim($_POST["password"])))
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
                                $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
                                $role = htmlspecialchars($_POST["role"]);
                                $email = htmlspecialchars($_POST["email"]);
                                $user = new User($firstName, $lastName,  $address, $phone, $email, $password, $role);
                                
                                dump($_POST);
                                $um->createAdmin($user);

                                $_SESSION["user"] = $user->getId();

                                unset($_SESSION["error-message"]);

                                
                                $this->redirect("index.php=register");
                            }
                            else
                            {
                                $_SESSION["error-message"] = "A user already exists with this email";
                                $this->redirect("index.php?route=register");
                            }
                        }
                        else 
                        {
                            $_SESSION["error-message"] = "Password is not strong enough";
                            $this->redirect("index.php?route=register");
                        }
                    }
                    else
                    {
                        $_SESSION["error-message"] = "The passwords do not match";
                        $this->redirect("index.php?route=register");
                    }
                }
                else
                {
                    $_SESSION["error-message"] = "Invalid CSRF token";
                    $this->redirect("index.php?route=register");

                }
            }
            else
            {   
                $_SESSION["error-message"] = "Missing fields";
                $this->redirect("index.php?route=register");
            }
        }
        else
        {
            $_SESSION["error-message"] = "Vous n'êtes pas autorisé à effectuer cette action.";
            $this->redirect("index.php?route=admin-users-role");
            //dump($_SESSION);
            
        }
        
    }

    public function updateAdmin() : void
    {
        if(isset($_SESSION["role"]) && ($_SESSION["role"] === "ADMIN"  || $_SESSION["role"] === "READER"))
        {
            $um = new UserManager();
            $userById = $um->findOne($_GET["id"]);
            
            unset($_SESSION["message"]);
            unset($_SESSION["error-message"]);
            $this->render("update-admin.html.twig", ["userById" => $userById]);

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé";
            $this->redirect("index.php?route=login");
        }
        
    }

    public function checkUpdateAdmin() : void
    {
        if(isset($_SESSION["role"]) && $_SESSION["role"] === "ADMIN")
        {

            $tokenManager = new CSRFTokenManager();
            
            
            if(isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"]))
            {

                if(isset($_POST))
                {
                    if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]))
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
                                $this->redirect("index.php?route=update-admin&id=" . $userId);
                                //dump($_SESSION);
                            } 
                        }
                        else
                        {
                            $newEmail = htmlspecialchars($_POST["email"]);
                        }
                       
                        if( !empty($_POST["password"]) && !empty($_POST["new-password"]) && !empty($_POST["confirm-password"]))
                        {
                            if(password_verify($_POST["password"], $user->getPassword()))
                            {
                               
                                    if($_POST["new-password"] === $_POST["confirm-password"])
                                    {
                                        $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9\s]).{8,}$/';

                                        if (preg_match($password_pattern, trim($_POST["new-password"])))
                                        {
                                            
                                            $firstName = htmlspecialchars($_POST["firstName"]);
                                            $lastName = htmlspecialchars($_POST["lastName"]);
                                            $address = null;
                                            $phone = htmlspecialchars($_POST["phone"]);
                                            $newPassword = password_hash($_POST["new-password"], PASSWORD_BCRYPT);
                                            $role = htmlspecialchars($_POST["role"]);
                                            $user = new User($firstName, $lastName,  $address, $phone, $newEmail, $newPassword, $role);
                                            $user->setId($userId);

                                            $um->updateAdmin($user);

                                            

                                            unset($_SESSION["error-message"]);
                                            $_SESSION["message"] = "Mise à jour de l'utilisateur effectuée avec succès";
                                            $_SESSION["role"] = "ADMIN";
                                            $this->redirect("index.php?route=update-admin&id=" . $userId);
                                            //dump($_SESSION);

                                            
                                        }
                                        else 
                                        {
                                            $_SESSION["error-message"] = "Ce mot de passe ne correspond pas aux critères de stratégie de mot de passe";
                                            $this->redirect("index.php?route=update-admin&id=" . $userId);
                                            //dump($_SESSION);
                                        }
                                    }
                                    else
                                    {
                                        $_SESSION["error-message"] = "Le nouveau mot de passe et la confirmation de mot de passe ne sont pas identique";
                                        $this->redirect("index.php?route=update-admin&id=" . $userId);
                                        //dump($_SESSION);
                                    }
                                
                                
                            }
                            else
                            {
                                $_SESSION["error-message"] = "Votre mot de passe actuel est incorrect";
                                $this->redirect("index.php?route=update-admin&id=" . $userId);
                                //dump($_SESSION);
                            }

                        }
                        elseif( !empty($_POST["password"]) && (empty($_POST["new-password"]) || empty($_POST["confirm-password"])))
                        {
                            $_SESSION["error-message"] = "Le nouveau mot de passe et la confirmation de mot de passe doivent être renseigner pour changer le mot de passe";
                            $this->redirect("index.php?route=update-admin&id=" . $userId);
                            //dump($_SESSION);
                        }
                        elseif(empty($_POST["password"]) && (!empty($_POST["new-password"]) || !empty($_POST["confirm-password"])))
                        {
                            $_SESSION["error-message"] = "Le mot de passe actuel doit être renseigner pour changer le mot de passe";
                            $this->redirect("index.php?route=update-admin&id=" . $userId);
                            //dump($_SESSION);
                        }
                        else
                        {
                            
                            $firstName = htmlspecialchars($_POST["firstName"]);
                            $lastName = htmlspecialchars($_POST["lastName"]);
                            $address = null;
                            $phone = htmlspecialchars($_POST["phone"]);
                            $newPassword = null;
                            $role = htmlspecialchars($_POST["role"]);
                            $user = new User($firstName, $lastName,  $address, $phone, $newEmail, $newPassword, $role);
                            $user->setId($userId);

                            $um->updateAdmin($user);

                            $_SESSION["role"] = "ADMIN";

                            unset($_SESSION["error-message"]);
                            $_SESSION["message"] = "Mise à jour de l'utilisateur effectuée avec succès";
                            
                            $this->redirect("index.php?route=update-admin&id=" . $userId);
                            //dump($_SESSION);
                        }
                    
                        

                        
                        
                    }
                    else
                    {   
                        $_SESSION["error-message"] = "Les champs Prénom, Nom, Email doivent être renseigné";
                        $this->redirect("index.php?route=update-admin&id=" . $_POST['userId']);
                        //dump($_SESSION);
                    }
                }
                else
                {
                    $_SESSION["error-message"] = "Une erreur est survenue";
                    $this->redirect("index.php?route=users-admin&role=admin");
                    //dump($_SESSION);

                }
            }
            else
            {
                $_SESSION["error-message"] = "Invalid CSRF token";
                $this->redirect("index.php?route=register");
                //dump($_SESSION);
            }
        }
        else
        {
            $_SESSION["error-message"] = "Vous n'êtes pas autorisé à effectuer cette action.";
            $this->redirect("index.php?route=admin-users-role");
            //dump($_SESSION);
            
        }

            
    }
    
    public function logout() : void
    {
        unset($_SESSION);
        session_destroy();
        $this->redirect("index.php");
    }
}