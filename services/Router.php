<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class Router
{
    private AuthController $ac;
    private DefaultController $bc;
    private RentController $cc;
    private AdminController $kc;


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
        else if(isset($get["route"]) && $get["route"] === "rent-property")
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
        else if(isset($get["route"]) && $get["route"] === "buy-property")
        {
            if(isset($get["property-id"]))
            {
                $this->dc->buy($get["property-id"]);
            }
            else
            {
                $this->bc->home();
            }
        }
        else if(isset($get["route"]) && $get["route"] === "sell")
        {
            $this->ec->sell();
        }
        else if(isset($get["route"]) && $get["route"] === "manage")
        {
            $this->fc->manage();
        }
        else if(isset($get["route"]) && $get["route"] === "contact")
        {
            $this->gc->contact();
        }
        else if(isset($get["route"]) && $get["route"] === "legal-information")
        {
            $this->hc->legalInformation();
        }
        else if(isset($get["route"]) && $get["route"] === "privacy-policy")
        {
            $this->ic->privacyPolicy();
        }
        else if(isset($get["route"]) && $get["route"] === "cookies-policy")
        {
            $this->jc->cookiesPolicy();
        }
        else if(isset($get["route"]) && $get["route"] === "admin")
        {
            $this->kc->admin();
        }
        else if(isset($get["route"]) && $get["route"] === "add-property")
        {
            $this->kc->addProperty();
        }
        else if(isset($get["route"]) && $get["route"] === "view-property")
        {
            $this->kc->viewProperty();
        }
        else if(isset($get["route"]) && $get["route"] === "update-property")
        {
            $this->kc->updateProperty();
        }
        else if(isset($get["route"]) && $get["route"] === "delete-property")
        {
            $this->kc->deleteProperty();
        }
        else
        {
            $this->bc->home();
        }
    }
}