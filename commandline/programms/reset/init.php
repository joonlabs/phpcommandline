<?php
    function resetMain($args, $command){
        lCommand::write("> login");
        lCommand::write("connection resetted successfully. you've been logged out.");
        $_SESSION["commandstack"] = [];
        $_SESSION["authorized"] = false;
//        lCommand::addToStack("login");
//        lCommand::performNextCommand();
    }
?>