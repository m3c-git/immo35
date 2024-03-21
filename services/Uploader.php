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

        if(isset($_POST))
        {
        $this-> propertyId = $_POST['propertyId'];
        }
    }

    /**
     * @param array $files your $_FILES superglobal
     * @param string $uploadField the name of of the type="file" input
     *
     */
    public function upload(array $files, string $uploadField, ) : ?Media
    {
        foreach($files as $file)
        {
        if(isset($files[$uploadField]) && isset($this->propertyId)){
            try {
                $file_name = $files[$uploadField]['name'];
                $file_tmp =$files[$uploadField]['tmp_name'];

                $tabFileName = explode('.',$file_name);
                $file_ext=strtolower(end($tabFileName));
                //dump($file_ext);
                
                    $newFileName = $this->gen->generate(8);
                    $url = $newFileName.".".$file_ext;
                    //$type = null;
                    $keys = array_keys($_FILES);
                    
                if(in_array($file_ext, $this->extensions) === false && $file_ext !== ""){
                   throw new Exception("Bad file extension. Please upload a JPG, PDF or PNG file.");
                }
                elseif($uploadField === $keys[0])
                {

                    move_uploaded_file($file_tmp, $this->uploadFolder."/".$url);
                    $type = "vignette";
                    return new Media($url, $this->propertyId, $type);
                
                }
                else
                {   
                    move_uploaded_file($file_tmp, $this->uploadFolder."/".$url);
                    $type = null;
                    return new Media($url, $this->propertyId, $type);

                }
                
                  
                    
                
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                return null;
            }

        }
        //dump("2");
        return null;
    }
    }
}