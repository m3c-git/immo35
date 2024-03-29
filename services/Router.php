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
        $this->hc = new AdminController();
        $this->bc = new DefaultController();
        $this->cc = new PropertyController();
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
        else if(isset($get["route"]) && $get["route"] === "result")
        {
            $this->bc->research();
        }
        else if(isset($get["route"]) && $get["route"] === "details-property")
        {
            $this->cc->detailsProperty();
        }
        else if(isset($get["route"]) && $get["route"] === "rent")
        {
            if(isset($get["status"]) && $get["status"] === "A LOUER")
            {
                $this->cc->showPropertysByStatus($get["status"]);
            }
            else
            {
                $this->bc->page404();
            }
        }
        else if(isset($get["route"]) && $get["route"] === "buy")
        {
            if(isset($get["status"]) && $get["status"] === "A VENDRE")
            {
                $this->cc->showPropertysByStatus($get["status"]);
            }
            else
            {
                $this->bc->page404();
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
        else if(isset($get["route"]) && $get["route"] === "admin-users-role")
        {
            $this->hc->adminUsersRole();
        }
        else if(isset($get["route"]) && ($get["route"] === "users-proprietaire" || $get["route"] === "users-locataire" || $get["route"] === "users-admin"))
        {
            if(isset($get["role"]))
            {
                $this->hc->adminUsersByRole();
            }
            else
            {
                $this->hc->admin();
            }
        }
        else if(isset($get["route"]) && $get["route"] === "add-user")
        {
            $this->hc->addUser();
        }
        else if(isset($get["route"]) && $get["route"] === "checkAddUser")
        {
            $this->hc->checkAddUser();
        }
        else if(isset($get["route"]) && $get["route"] === 'update-user')
        {
            $this->hc->updateUser();
        }
        else if(isset($get["route"]) && $get["route"] === 'check-update-user')
        {
            $this->hc->checkUpdateUser();
        }
        else if(isset($get["route"]) && $get["route"] === 'delete-user')
        {
            $this->hc->deleteUser();
        }
        else if(isset($get["route"]) && $get["route"] === 'admin-property-type')
        {
            $this->hc->adminPropertyType();
        }
        else if(isset($get["route"]) && ($get["route"] === "admin-property-by-type"))
        {
            if(isset($get["type"]))
            {
                $this->hc->adminPropertysByType();
            }
            else
            {
                $this->hc->adminPropertyType();
            }
        }
        else if(isset($get["route"]) && $get["route"] === "add-property")
        {
            $this->hc->addProperty();
        }
        else if(isset($get["route"]) && $get["route"] === "check-add-property")
        {
           
            $this->hc->checkAddProperty();
            
            
        }
        else if(isset($get["route"]) && $get["route"] === "update-property")
        {
            if(isset($get["id"]))
            {
                $this->hc->updateProperty();
            }
            else
            {
                $this->hc->adminPropertysByType();
            }
            
        }
        else if(isset($get["route"]) && $get["route"] === "check-update-property")
        {
           
            $this->hc->checkUpdateProperty();
            
            
        }
        else if(isset($get["route"]) && $get["route"] === "delete-property")
        {
            $this->hc->deleteProperty();
        }
        else if(!isset($get["route"]))
        {
            $this->bc->home();
        }
        else
        {
            $this->bc->page404();
        }
    }
}