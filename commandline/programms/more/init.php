<?php
    function moreMain($args, $command){
        lCommand::write("> $command");
        if(count($args)==1){
            if(lSystem::fileExists(lSystem::getPWD()."/".$args[0])){
                lCommand::write(nl2br(htmlentities(file_get_contents(lSystem::getPWD()."/".$args[0]))));
            }else{
                lCommand::write("file not found");
            }
        }else{
            lCommand::write("to view a file,  call \"more [filename]\"");
        }
    }
?>