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

    protected function redirect(string $route) : void
    {
        header("Location: $route");
    }

    public function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}