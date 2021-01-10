<?php
    function cdMain($args, $command){
        lCommand::write("> $command");
        if(count($args)==1){
            $dir = $args[0];
            $new_dir = change_dir($dir);
            if($new_dir!==false) lCommand::write("changed to ".$new_dir);
            else lCommand::write("this is not a directory");
        }else{
            lCommand::write("to change directory, call \"cd [directory]\"");
        }
    }

    function change_dir($dir){
        $dir = rtrim($dir,"/");
        if($dir[0]=="/"){
            if(lSystem::dirExists($dir)){
                lSystem::setPWD($dir);
                return $dir;
            }
            return false;
        }else if($dir[0]=="."){
            $subDirs = explode("/", $dir);
            $c_dir = "";
            if($subDirs[0]==".."){
                $c_dir = implode("/",array_slice(explode("/", lSystem::getPWD()), 0, -1));
                if(lSystem::dirExists($c_dir)) {
                    lSystem::setPWD($c_dir);
                }else{
                    return false;
                }
            }
            if(count($subDirs)>1){
                return change_dir(implode("/", array_slice($subDirs, 1)));
            }
            return $c_dir;
        }else{
            $dir = lSystem::getPWD()."/".$dir;
            if(lSystem::dirExists($dir)) {
                lSystem::setPWD($dir);
                return $dir;
            }
            return false;
        }
    }
?>