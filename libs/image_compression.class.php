<?php

class ImgCompression{
    public function __construct($source, $destination, $quality){
        $name = explode("/", $source);

        if(file_exists($destination."/".$this->lowerReplace($name[3]))){
            if(file_exists($destination."/".$this->lowerReplace($name[3])."/".$this->lowerReplace($name[4]))){
                if(file_exists($destination."/".$this->lowerReplace($name[3])."/".$this->lowerReplace($name[4])."/".$this->lowerReplace($name[5]))){

                    // Get image info 
                    $imgInfo = getimagesize($source); 
                    $mime = $imgInfo['mime']; 

                    // Create a new image from file 
                    switch($mime){ 
                        case 'image/jpeg': 
                            $image = imagecreatefromjpeg($source);
                            break; 
                        case 'image/png': 
                            $image = imagecreatefrompng($source); 
                            break; 
                        case 'image/gif': 
                            $image = imagecreatefromgif($source); 
                            break; 
                        case 'image/jpg': 
                            $image = imagecreatefromjpg($source); 
                            break; 
                        default: 
                            $image = imagecreatefromjpeg($source); 
                    } 

                    $format = explode(".", $name[6]);
                    $format1 = str_replace($format[0], $this->lowerReplace($name[4])."_".$this->lowerReplace($format[0])) ;
                    $path = $destination."/".$name[3]."/".$name[4]."/".$name[5]."/".$this->lowerReplace($name[4])."_".$this->lowerReplace($format[0].".jpg");
                    $path = $this->lowerReplace($path);
  

                    echo $path."<br/>"; 
                    
                    if(!imagejpeg($image, $path, $quality)){
                        throw new Exception("Image Compression Something wrong ...");
                    }
                
                    // Return compressed image 
                    return "Image Compression Done ..."; 
                
                }
                else{
                    throw new Exception($destination."/".$name[3]."/".$name[4]."/".$name[5]." => Folder Doesn't Existes ...");
                }
            }
            else{
                throw new Exception($destination."/".$name[3]."/".$name[4]." => Folder Doesn't Existes 2nd Lavel ...");
            }
        }
        else{
            throw new Exception($destination."/".$name[3]." => Folder Doesn't Existes ...");
        }
        
    }

    public function lowerReplace($name){
        return preg_replace('/\ +/', '_', strtolower($name));
    }
}



?>