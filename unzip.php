<?php
$dir = "C:/Users/LENOVO/Downloads/img";

function listed($dir){

    $ffs = scandir($dir);

    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);

    // prevent empty ordered elements
    if (count($ffs) < 1)
        return;

    foreach($ffs as $ff){
        if(is_dir($dir.'/'.$ff)){
            // $opt_var = $_SERVER['DOCUMENT_ROOT']."/test-2/".$ff."/";
            listed($dir.'/'.$ff);

            // if(!file_exists($opt_var)){
            //     mkdir($opt_var);
            // }
            // else{
            // }
        }
        elseif(is_file($dir.'/'.$ff)){

            $file = $dir.'/'.$ff;

            $image = imagecreatefromstring(file_get_contents($dir.'/'.$ff));
            ob_start();
            imagejpeg($image, NULL, 100);
            $cont = ob_get_contents();
            ob_end_clean();
            imagedestroy($image);
            $content = imagecreatefromstring($cont);

            $file = explode("/", $file);
            $extension = explode(".", $file[count($file)-1]);
            // $opt_path = $file[0]."/".$file[1]."/".$file[2]."/opt/".$file[4]."/".$file[5]."/".$file[6]."/".$extension[0].".webp";
            
            // $output = $opt_path;
            if(imagewebp($content, "C:/Users/LENOVO/Downloads/img-opt/".$extension[0].".webp")){
                echo "Done<br/>";
            }
            else{
                echo "Failed<br/>";
            }
            
            imagedestroy($content);
        }
    }
}
listed($dir);





exit;
$zip = new ZipArchive;
$res = $zip->open('C:/Users/LENOVO/Downloads/Optimized-1692597748.2652.zip');
if ($res === TRUE) {
  $zip->extractTo('./');
  $zip->close();
  echo 'woot!';
} else {
  echo 'doh!';
}