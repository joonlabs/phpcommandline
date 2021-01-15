<?php
    use PHPCommandLine\lCommand;
    use PHPCommandLine\lSystem;

    function rmMain($args, $command){
        lCommand::write("> $command");
        if(count($args)==1){
            $file = lSystem::getPWD()."/".$args[0];
            if(lSystem::fileExists($file)){
                if(lSystem::isFile($file)){
                    lSystem::rmFile($file);
                }else{
                    lCommand::write("this is a directory and can only be removed by \"rm -rf [directory]\"");
                }
            }else{
                lCommand::write("this file does not exists");
            }
        }else if(count($args)==2) {
            if($args[0]=="-rf"){
                $dir = lSystem::getPWD()."/".$args[1];
                if(lSystem::dirExists($dir)){
                    lSystem::rmDir($dir);
                }else{
                    lCommand::write("this directory does not exists");
                }
            }else{
                lCommand::write("to remove a file, call \"rm [file]\", to remove a directory, call \"rm -rf [directory]\"");
            }
        }else{
            lCommand::write("to remove a file, call \"rm [file]\", to remove a directory, call \"rm -rf [directory]\"");
        }
    }
?>