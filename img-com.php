<?php

function compressImage($source, $destination, $quality) { 
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
     
    // Save image 
    if(imagejpeg($image, $destination."/new.png", $quality)){
        echo "Done";
    }
    else{
        echo "Failure";
    }

    // Return compressed image 
    return $destination; 
}

compressImage($_SERVER['DOCUMENT_ROOT']."/test/gallery.png", $_SERVER['DOCUMENT_ROOT']."/test/pressure-part", 20)


?>