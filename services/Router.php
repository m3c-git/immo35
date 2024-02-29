<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class Router
{
    private AuthController $ac;
    private DefaultController $bc;
    private PropertyController $cc;
    private AdminController $hc;


    public function __construct()
    {
        $this->ac = new AuthController();
        $this->bc = new DefaultController();
    }
    public function handleRequest(array $get) : void
    {
        if(!isset($get["route"]))
        {
            $this->bc->home();
        }
        else if(isset($get["route"]) && $get["route"] === "register")
        {
            $this->ac->register();
        }
        else if(isset($get["route"]) && $get["route"] === "check-register")
        {
            $this->ac->checkRegister();
        }
        else if(isset($get["route"]) && $get["route"] === "login")
        {
            $this->ac->login();
        }
        else if(isset($get["route"]) && $get["route"] === "check-login")
        {
            $this->ac->checkLogin();
        }
        else if(isset($get["route"]) && $get["route"] === "logout")
        {
            $this->ac->logout();
        }
        else if(isset($get["route"]) && $get["route"] === "rent")
        {
            if(isset($get["property-id"]))
            {
                $this->cc->rent($get["property-id"]);
            }
            else
            {
                $this->bc->home();
            }
        }
        else if(isset($get["route"]) && $get["route"] === "buy")
        {
            if(isset($get["property-id"]))
            {
                $this->cc->buy($get["property-id"]);
            }
            else
            {
                $this->bc->home();
            }
        }
        else if(isset($get["route"]) && $get["route"] === "sell")
        {
            $this->cc->sell();
        }
        else if(isset($get["route"]) && $get["route"] === "manage")
        {
            $this->cc->manage();
        }
        else if(isset($get["route"]) && $get["route"] === "contact")
        {
            $this->dc->contact();
        }
        else if(isset($get["route"]) && $get["route"] === "legal-information")
        {
            $this->ec->legalInformation();
        }
        else if(isset($get["route"]) && $get["route"] === "privacy-policy")
        {
            $this->ec->privacyPolicy();
        }
        else if(isset($get["route"]) && $get["route"] === "cookies-policy")
        {
            $this->gc->cookiesPolicy();
        }
        else if(isset($get["route"]) && $get["route"] === "admin")
        {
            $this->hc->admin();
        }
        else if(isset($get["route"]) && $get["route"] === "add-property")
        {
            $this->hc->addProperty();
        }
        else if(isset($get["route"]) && $get["route"] === "view-property")
        {
            $this->hc->viewProperty();
        }
        else if(isset($get["route"]) && $get["route"] === "update-property")
        {
            $this->hc->updateProperty();
        }
        else if(isset($get["route"]) && $get["route"] === "delete-property")
        {
            $this->hc->deleteProperty();
        }
        else
        {
            $this->bc->home();
        }
    }
}