<?php
use PHPCommandLine\lCommand;
use PHPCommandLine\lSystem;

function mkdirMain($args, $command){
    lCommand::write("> $command");
    if(count($args)==1){
        if(strlen($args[0])>0) {
            $result = mkdir(lSystem::getPWD()."/".$args[0]);
        }
        else lCommand::write("please specify a dirname");
    }else{
        lCommand::write("to ceate a new directory,  call \"mkdir [dirname]\"");
    }

}
?>