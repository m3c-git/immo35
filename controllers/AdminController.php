<?php

class AdminController extends AbstractController
{
    public function admin() : void
    {
        $this->render("home-admin.html.twig", []);
    
    }

    public function users() : void
    {

        if(isset($_SESSION["role"]) && $_SESSION["role"] === "ADMIN")
        {
            $tokenManager = new CSRFTokenManager();

            if(isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"]))
            {
                $um = new UserManager();
                $user = $um->findByRole($_GET["role"]);

                if($user !== null)
                {
                    if(password_verify($_POST["password"], $user->getPassword()))
                    {
                        $_SESSION["user"] = $user->getId();

                        unset($_SESSION["error-message"]);

                        $this->redirect("index.php?route=admin");
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


/*     public function admin() : void
    {
        $this->render("home-admin.html.twig", []);
    } */


}