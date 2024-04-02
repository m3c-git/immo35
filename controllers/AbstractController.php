<?php

abstract class AbstractController
{
    private \Twig\Environment $twig;
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(['templates', 'templates-admin']);
        $twig = new \Twig\Environment($loader,[
            'debug' => true,
        ]);
        $twig->addGlobal('token', $_SESSION["csrf-token"]);
        if(isset($_SESSION["error-message"]))
        {
            $twig->addGlobal('errormessage', $_SESSION["error-message"]);
        }
        elseif(isset($_SESSION["message"]))
        {
            $twig->addGlobal('message', $_SESSION["message"]);
        }
        
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        $this->twig = $twig;
    }

    protected function render(string $template, array $data) : void
    {
        echo $this->twig->render($template, $data);
    }

    protected function renderJson(array $data) : void
    {
    echo json_encode($data);
    }

    protected function redirect(string $route) : void
    {
        header("Location: $route");
    }

    
    /* Fonction pour empêcher d'entrer du code dans un formulaire  */
    public function checkInput($data)
    {
        $data = trim($data); // Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
        $data = stripslashes($data); // Supprime les antislashs d'une chaîne
        $data = htmlspecialchars($data); // Convertit les code HTML ou JavaScript en texte simple
        return $data;
    }

    /* Fonction pour vérifier si un numéro de téléphone est valide  */
    public function isphone($var)
    {
        return preg_match("/^[0-9 ]*$/", $var);
    }

    /* Fonction pour vérifier si un email est valide  */
    public function isEmail($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }
}