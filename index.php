<pre>
<?php
error_reporting(0);
include_once 'libs/folder_creation.class.php';
include_once 'libs/folder_list.class.php';
include_once 'libs/image_compression.class.php';

require_once('vendor/autoload.php');
use \ConvertApi\ConvertApi;


#### Folder Creation Properties #####
$folder_creating_path = $_SERVER['DOCUMENT_ROOT'].'/tensile/assets/images';
$nested_folder = ['cover', 'about', 'gallery'];

#### Folder List Properties #####
$dir = $_SERVER['DOCUMENT_ROOT']."/opt";

#### ImageCompression Properties #####
$source = $_SERVER['DOCUMENT_ROOT']."/pressure/Autoclave/cover/Autoclave-cover.png";
$dest = $_SERVER['DOCUMENT_ROOT'].'/opt';
$quality = 20;


function getMenus(){
    $config_json = file_get_contents('../tensile/nav.json');
    $config = json_decode($config_json, true);
    return $config;
}

try{
    // $fcreate = new FCreate($folder_creating_path, $nested_folder, getMenus());
    $list_folder = new Folder_list($dir);
    // print_r($list_folder);
    // $image_compression = new ImgCompression($source, $dest, $quality);

}
catch(Exception $e){
    echo $e->getMessage();
}



?>
</pre>

