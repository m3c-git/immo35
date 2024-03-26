<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class Uploader {

    private array $extensions = ["jpeg","jpg","png", "pdf"];
    private string $uploadFolder = "upload";
    private string $propertyId;
    private RandomStringGenerator $gen;

    public function __construct()
    {
        $this->gen = new RandomStringGenerator();

        if(isset($_POST['propertyId']))
        {
        $this-> propertyId = $_POST['propertyId'];
        }
        else
        {
            $this-> propertyId = $_SESSION["new-property-id"];
        }
    }
    
    function reArrayFiles($file_post) {//dump($_FILES);

        $file_ary = array();//dump($file_post);
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);
    
        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $field => $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
    
        return $file_ary;
    }
    
    /**
     * @param array $files your $_FILES superglobal
     * @param string $key the name of of the type="file" input
     *
     */
    public function upload(array $files, int $key) : ?Media
    {
       //foreach($files as $file)
        //{dump($files);
        if(isset($files)){
            try {
                $file_name = $files['name'];
                $file_tmp =$files['tmp_name'];

                $tabFileName = explode('.',$file_name);
                $file_ext=strtolower(end($tabFileName));
                
                
                    $newFileName = $this->gen->generate(8);
                    $url = $newFileName.".".$file_ext;
                    //$type = null;
                    $keys = array_keys($_FILES);
                    
                if(in_array($file_ext, $this->extensions) === false && $file_ext !== ""){
                   throw new Exception("Bad file extension. Please upload a JPG, PDF or PNG file.");
                }
                elseif(!empty($file_name) && $key === 0)
                {
                    if(!move_uploaded_file($file_tmp, $this->uploadFolder."/".$url))
                    {
                        throw new Exception("Il y a eu une erreur lors de l'upload");
                    
                    }
                    else
                    {echo "1";
                        $type = "vignette";
                        return new Media($url, $this->propertyId, $type);

                    }
                    
                
                }
                elseif(!empty($file_name))
                {   
                    if(!move_uploaded_file($file_tmp, $this->uploadFolder."/".$url))
                    {dump("ici",$file_tmp, $this->uploadFolder."/".$url);
                        throw new Exception("Il y a eu une erreur lors de l'upload");

                    }
                    else
                    {echo "2";
                        $type = null;
                        return new Media($url, $this->propertyId, $type);
                    }
                    

                }
                
                  
                    
                
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                return null;
            }

        //}
        //dump("2");
        return null;
    }
    }
}