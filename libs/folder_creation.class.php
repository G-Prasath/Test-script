<?php

class FCreate{

    public function __construct($path, $sub_folder, $menus){
        $this->path = $path;
        $this->sub_folder = $sub_folder;
        $this->menus = $menus; 

        // $menus = getMenus();
        $flag = 0;
        $this->dir = scandir($path);

        foreach($menus as $key => $val){
            foreach($this->dir as $folder){
                $key = strtolower(str_replace(" ", "-", $key));
                
                // 1 st LAVEL FOLDER CREATING 
                if($folder == $key){
                    if(is_dir($path."/".$folder)){
                        foreach($val as $value){

                            // 2 nd LAVEL FOLDER CREATING 
                            $subFolder = strtolower(str_replace(" ", "_", $value));
                            mkdir($path."/".$folder."/".$subFolder);
                            if(is_dir($path."/".$folder."/".$subFolder)){

                                // 3 rd LAVEL FOLDER CREATING
                                foreach($sub_folder as $nstfolder){
                                    mkdir($path."/".$folder."/".$subFolder."/".$nstfolder);
                                    $flag = 1;
                                }
                            }
                            else{
                                throw new Exception("Is Not a Folder");
                            }
                        
                        }
                    }
                    else{
                        throw new Exception(" 1St Lavel Is Not a Folder");
                    }
                }
                else{
                    mkdir($path."/".$key);
                }
            }
        }
        if($flag == 1){
            echo "Folders Created Done ...";
        }
    }


}





?>