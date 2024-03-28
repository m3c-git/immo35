<?php

class DefaultController extends AbstractController
{
    public function home() : void
    { 

        $this->render("home.html.twig", []);
    }

    public function page404() : void
    {
        $this->render("404.html.twig", []);
    }
}