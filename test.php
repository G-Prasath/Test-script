<?php
$dir = $_SERVER['DOCUMENT_ROOT']."/mekarkprefab/images/pr";



function listed($dir){

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
            listed($dir.'/'.$ff);
        } 
        elseif(is_file($dir.'/'.$ff)){
            $file = $dir.'/'.$ff;
            // echo $file."<br/>";

            $image = imagecreatefromstring(file_get_contents($file));
            if($image){
                ob_start();
                imagejpeg($image, NULL, 100);
                $cont = ob_get_contents();
                ob_end_clean();
                imagedestroy($image);
                $content = imagecreatefromstring($cont);

                $file = explode("/", $file);        
                $extension = explode(".", $file[count($file)-1]);
                $opt_path = $_SERVER['DOCUMENT_ROOT']."/test-2/";       
                for ($i=6; $i < count($file)-1; $i++) { 
                    $opt_path = $opt_path.$file[$i]."/";
                }       
                $output = $opt_path.$extension[0].".webp";
                if(!imagewebp($content, $output)){
                    echo "Failed . . .<br/>";
                }
                imagedestroy($content);     
            }
            else{
                echo "Failed File ".$file;
            }
            
            // echo "<h3>Image Done</h3><br/>";
        }

    }
}

listed($dir);


?>