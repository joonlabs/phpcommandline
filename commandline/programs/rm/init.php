<?php
    use PHPCommandLine\lCommand;
    use PHPCommandLine\lSystem;

    function rmMain($args, $command){
        lCommand::write("> $command");
        if(count($args)==1){
            $file = lSystem::getPWD()."/".$args[0];
            if(lSystem::fileExists($file)){
                if(lSystem::isFile($file)){
                    unlink($file);
                }else{
                    lCommand::write("this is a directory and cannot be removed with this command");
                }
            }else{
                lCommand::write("this file does not exists");
            }
        }else{
            lCommand::write("to remove a file, call \"rm [file]\"");
        }
    }
?>