<?php
    function pwdMain($args, $command){
        lCommand::write("> $command");
        $pwd = lSystem::getPWD();
        lCommand::write("$pwd");
    }
?>