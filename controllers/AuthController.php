<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class AuthController extends AbstractController
{
    public function login() : void
    {
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
                        if($user->getRole() === "ADMIN")
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
                        $_SESSION["error-message"] = "Invalid login information";
                        $this->redirect("index.php?route=login");
                    }
                }
                else
                {
                    $_SESSION["error-message"] = "Invalid login information";
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
        if($_SESSION["role"] === "ADMIN")
        {
            $this->render("register.html.twig", []);

        }
        else
        {
            $_SESSION["error-message"] = "Utilisateur non autorisé à se connecter";
            $this->redirect("index.php?route=login");
        }
        
    }

    public function checkRegister() : void
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
                            
                            
                            $um->createAdmin($user);

                            $_SESSION["user"] = $user->getId();

                            unset($_SESSION["error-message"]);

                            $this->redirect("index.php");
                        }
                        else
                        {
                            $_SESSION["error-message"] = "A user already exists with this email";
                            $this->redirect("index.php?route=register");
                        }
                    }
                    else {
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

    public function logout() : void
    {
        unset($_SESSION);
        session_destroy();
        $this->redirect("index.php");
    }
}