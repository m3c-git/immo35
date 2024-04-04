<?php

class PropertyController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function showAllPropertys() : void
    {
        //$this->render("home.html.twig", []);
    }

    public function contactManage() : void
    {
      
        //dump($propertyById);
        //dump($propertyById, $usersProprietaire, $usersLocataire, $_FILES);

        unset($_SESSION["message"]);
        $this->render("contact-manage.html.twig", []);

    }

    public function checkContactManage() : void
    {


        $array = array("civilite" => "", "lastname" => "", "firstname" => "", "phone" => "", "email" => "", "district" => "", "city" => "",
        "civiliteError" => "", "lastnameError" => "", "firstnameError" => "", "emailError" => "", "phoneError" => "", "districtError" => "", "cityError" => "", "isSuccessf" => false);
        
        $emailTo = "contact@mawqi3creation.com";
        


        if (isset($_POST))
        {
            $array["civilite"]  = $_POST["civilite"];
            $array["lastname"]  = $this->checkInput($_POST["lastname"]);
            $array["firstname"] = $this->checkInput($_POST["firstname"]);
            $array["phone"] = $this->checkInput($_POST["phone"]);
            $array["email"] = $this->checkInput($_POST["email"]);
            $array["district"] = $this->checkInput($_POST["district"]);
            $array["city"] = $this->checkInput($_POST["city"]);
            $array["isSuccessf"] = true;
            $emailText = "";

            if(empty($array["civilite"]))
            {
                $array["civiliteError"] = "Merci de selectionner votre civilité !";
                $array["isSuccessf"] = false;
            }
            else
            {
                $emailText .= "Civilité: {$array["civilite"]}\n";
            }
        
            if(empty($array["lastname"]))
            {
                $array["lastnameError"] = "Merci de renseigner votre nom !";
                $array["isSuccessf"] = false;
            }
            else
            $emailText .= "Nom: {$array["lastname"]}\n";

            if(empty($array["firstname"]))
            {
                $array["firstnameError"] = "Merci de renseigner votre prenom !";
                $array["isSuccessf"] = false;
            }
            else
            $emailText .= "prenom: {$array["firstname"]}\n";

            if(!$this->isphone($array["phone"]))
            {
                $array["phoneError"] = "Saisisez uniquement des chiffres et des espaces !";
                $array["isSuccessf"] = false;
            }
            else
            $emailText .= "Téléphone: {$array["phone"]}\n";
            
            if(!$this->isEmail($array["email"]))
            {
                $array["emailError"] = "Merci de renseigner un email valide !";
                $array["isSuccessf"] = false;
            }
            else
            $emailText .= "Email: {$array["email"]}\n";

            if(empty($array["city"]))
            {
                $array["cityError"] = "Merci de renseigner votre ville !";
                $array["isSuccessf"] = false;
            }
            else
            {
                $emailText .= "Ville: {$array["city"]}\n";

            }

            if(empty($array["district"]))
            {
                $array["districtError"] = "Merci de renseigner un code postal valide !";
                $array["isSuccessf"] = false;
            }
            else
            {
                $emailText .= "Code postal: {$array["district"]}\n";

            }

            if($array["isSuccessf"])
            {
                ini_set("smtp_port","1025"); // force la config du port smtp pour maildev parce que la modification du fichier ini de php ne semble pas être prise en compte par php.
                $headers = "From: {$array["firstname"]} {$array["lastname"]} <{$array["email"]}>\r\nReply-To: {$array["email"]}";
                $headers .="Content-Type: text/html; charset=utf-8"."\n";
                mail($emailTo, "Test formulaire PHP", $emailText, $headers);

                // adresse maildev pour test envoie de mail en local : http://localhost:1080/#/
                
            }
        


        }
        //echo json_encode($array);
        $this->renderJson($array);


        $array = array("civilite" => "", "lastname" => "", "firstname" => "", "phone" => "", "email" => "", "district" => "", "city" => "",
        "civiliteError" => "", "lastnameError" => "", "firstnameError" => "", "emailError" => "", "phoneError" => "", "districtError" => "", "cityError" => "", "isSuccessf" => false);
            
        
            //dump($propertyById);
            //dump($propertyById, $usersProprietaire, $usersLocataire, $_FILES);

            //unset($_SESSION["message"]);
        
        
    }


    public function contact() : void
    {

        //dump($propertyById);
        //dump($propertyById, $usersProprietaire, $usersLocataire, $_FILES);

        unset($_SESSION["message"]);
        $this->render("contact.html.twig", []);
        
    }


    public function checkContact() : void
    {
        

        $array = array("civilite" => "", "lastname" => "", "firstname" => "", "company" => "", "function" => "", "phone" => "", "email" => "", "district" => "", "city" => "", "message" => "",
        "civiliteError" => "", "lastnameError" => "", "firstnameError" => "", "emailError" => "", "companyError" => "", "phoneError" => "", "districtError" => "", "cityError" => "", "messageError" => "", "isSuccessf" => false);
        
        $emailTo = "contact@mawqi3creation.com";
        


        if (isset($_POST))
        { //dump($_POST);
            $array["profil"]  = $_POST["profil"];
            $array["civilite"]  = $_POST["civilite"];
            $array["lastname"]  = $this->checkInput($_POST["lastname"]);
            $array["firstname"] = $this->checkInput($_POST["firstname"]);
            $array["phone"] = $this->checkInput($_POST["phone"]);
            $array["email"] = $this->checkInput($_POST["email"]);
            $array["district"] = $this->checkInput($_POST["district"]);
            $array["city"] = $this->checkInput($_POST["city"]);
            $array["message"] = $this->checkInput($_POST["message"]);
            $array["isSuccessf"] = true;
            $emailText = "";

            $emailText .= "Profil: {$array["profil"]}\n";

            if (isset($_POST["demande-particulier"]))
            {
                $array["demande-particulier"]  = $_POST["demande-particulier"];
                $emailText .= "Demande particulier: {$array["demande-particulier"]}\n";
            }
            
            if (isset($_POST["demande-professionnelle"]))
            {
                $array["demande-professionnelle"]  = $_POST["demande-professionnelle"];
                $emailText .= "Demande professionnelle: {$array["demande-professionnelle"]}\n";
            }
            
            if(empty($array["civilite"]))
            {
                $array["civiliteError"] = "Merci de selectionner votre civilité !";
                $array["isSuccessf"] = false;
            }
            else
            {
                $emailText .= "Civilité: {$array["civilite"]}\n";
            }
        
            if(empty($array["lastname"]))
            {
                $array["lastnameError"] = "Merci de renseigner votre nom !";
                $array["isSuccessf"] = false;
            }
            else
            $emailText .= "Nom: {$array["lastname"]}\n";

            if(empty($array["firstname"]))
            {
                $array["firstnameError"] = "Merci de renseigner votre prenom !";
                $array["isSuccessf"] = false;
            }
            else
            $emailText .= "prenom: {$array["firstname"]}\n";

            if (isset($_POST["company"]))
            {
                $array["company"]  = $_POST["company"];
                if(empty($array["company"]))
                {
                    $array["companyError"] = "Merci de renseigner votre société !";
                    $array["isSuccessf"] = false;
                }
                else
                $emailText .= "Société: {$array["company"]}\n";
            }

            if (isset($_POST["function"]))
            {
                $array["function"]  = $_POST["function"];

                $emailText .= "Fonction: {$array["function"]}\n";
            }

            if(!$this->isphone($array["phone"]))
            {
                $array["phoneError"] = "Saisisez uniquement des chiffres et des espaces !";
                $array["isSuccessf"] = false;
            }
            else
            $emailText .= "Téléphone: {$array["phone"]}\n";
            
            if(!$this->isEmail($array["email"]))
            {
                $array["emailError"] = "Merci de renseigner un email valide !";
                $array["isSuccessf"] = false;
            }
            else
            $emailText .= "Email: {$array["email"]}\n";

            if(empty($array["city"]))
            {
                $array["cityError"] = "Merci de renseigner votre ville !";
                $array["isSuccessf"] = false;
            }
            else
            $emailText .= "Ville: {$array["city"]}\n";

            if(empty($array["district"]))
            {
                $array["districtError"] = "Merci de renseigner un code postal valide !";
                $array["isSuccessf"] = false;
            }
            else
            $emailText .= "Code postal: {$array["district"]}\n";


            if(empty($array["message"]))
            {
                $array["messageError"] = "Qu'est-ce que tu veux me dire ?";
                $array["isSuccessf"] = false;
            }
            else
            $emailText .= "Message: {$array["message"]}\n";


            if($array["isSuccessf"])
            {
                ini_set("smtp_port","1025"); // force la config du port smtp pour maildev parce que la modification du fichier ini de php ne semble pas être prise en compte par php.
                $headers = "From: {$array["firstname"]} {$array["lastname"]} <{$array["email"]}>\r\nReply-To: {$array["email"]}";
                $headers .="Content-Type: text/html; charset=utf-8"."\n";
                mail($emailTo, "Test formulaire PHP", $emailText, $headers);

                // adresse maildev pour test envoie de mail en local : http://localhost:1080/#/
                
            }
        


        }
        //echo json_encode($array);
        $this->renderJson($array);


        $array = array("civilite" => "", "lastname" => "", "firstname" => "", "company" => "", "function" => "", "phone" => "", "email" => "", "district" => "", "city" => "", "message" => "",
        "civiliteError" => "", "lastnameError" => "", "firstnameError" => "", "emailError" => "", "companyError" => "", "phoneError" => "", "districtError" => "", "cityError" => "", "messageError" => "", "isSuccessf" => false);
            
        
            //dump($propertyById);
            //dump($propertyById, $usersProprietaire, $usersLocataire, $_FILES);

            //unset($_SESSION["message"]);
        
        
    }


    public function showPropertysByStatus() : void // Liste des biens en location ou en vente  
    {
      
        $pm = new PropertyManager();
        $propertyStatus = $pm->findByStatus($_GET["status"]);

        $mm = new MediaManager();
        $mediasByType = $mm->findByTypeMedia($_GET["typeMedia"]);

        if($propertyStatus !== null)
        {
            $propertys = [];  

            foreach($propertyStatus as $property)
            {$val = "";
                foreach($mediasByType as $media)
                {
                    
                    if($property->getId() === $media->getPropertyId() && $media->getType() === "vignette")
                    {
                        $val= ["property" => $property, "vignette_url" => $media->getUrl()];
                    }
                    
                }                          
                if(!$val) 
                {
                    $val = ["property" => $property, "vignette_url" => "../assets/img/no-vignette.svg"];
                }
                $propertys[] = $val;
            }

            
            if($_GET["status"] === "A LOUER")
            {   unset($_SESSION["message"]);
                $this->render("rent.html.twig", ["propertys" => $propertys]);

            }
            elseif($_GET["status"] === "A VENDRE")
            {
                unset($_SESSION["message"]);
                $this->render("buy.html.twig", ["propertys" => $propertys]);

            }
        
        }
        else
        {
            $info = "Aucun biens trouvés";
            $this->render("buy.html.twig", ["info" => $info]);
            //dump($_SESSION["message"]);
        }

        
    }
    
        

    public function propertyDetails() : void // Afficher les détails d'un biens
    {
        $pm = new PropertyManager();
            $propertyById = $pm->findOne($_GET["id"]);

            $mm = new MediaManager();
            $mediaByIdProperty = $mm->findByIdProperty($_GET["id"]);
            
            if($mediaByIdProperty !== [])
            {
                if($mediaByIdProperty[0]->gettype() === null)
                {
                    $mm->updateMedia($mediaByIdProperty[0]);
                }
                $propertyById->setMedias($mediaByIdProperty);

            }


            $fm = new PropertyFeaturesManager();
            $featureByIdProperty = $fm->findFeatureByIdProperty($_GET["id"]);

            if($featureByIdProperty !== null)
            {
                $propertyById->setPropertyFeatures($featureByIdProperty);
            }

            unset($_SESSION["message"]);
            
            $this->render("details-property.html.twig", ["propertyById" => $propertyById, 
                                                        "featureByIdProperty" => $featureByIdProperty,
                                                        "mediaByIdProperty" => $mediaByIdProperty,
                                                        "noVignette" => "../assets/img/no-vignette.svg"

                                                    ]);
    }

}
