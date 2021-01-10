<?php
    function touchMain($args, $command){
        lCommand::write("> $command");
        if(count($args)==1){
            file_put_contents(lSystem::getPWD()."/".$args[0], "");
        }else if(count($args)==2){
            file_put_contents(lSystem::getPWD()."/".$args[0], $args[1]);
        }else{
            lCommand::write("to ceate a new file,  call \"touch [filename]\" or \"touch [filename] [content]\"");
        }

    }
?>