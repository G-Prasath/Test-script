<?php

class Folder_list{

    public function __construct($dir){
        
    $ffs = scandir($dir);

    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);

    // prevent empty ordered elements
    if (count($ffs) < 1)
        return;

    // echo '<ol>';
    foreach($ffs as $ff){
        // echo '<li>'.$ff;
        if(is_dir($dir.'/'.$ff)){
            new Folder_list($dir.'/'.$ff);
        } 
        elseif(is_file($dir.'/'.$ff)){
            if(preg_match("/\.(gif|png|jpg|jpeg)$/", $dir.'/'.$ff)){
                if(!new ImgCompression($dir.'/'.$ff, $_SERVER['DOCUMENT_ROOT'].'/opt', 50)){
                    throw new Exception("Image Compression Something Wrongs ...");
                }
            }
            else{
                throw new Exception("File Not Image Formate pls Check ...");
            }
        }
        // echo '</li>';
    }
    // echo '</ol>';
    }
}






?>