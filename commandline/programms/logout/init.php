<?php
    function logoutMain($args, $command){
        lCommand::write("> logout");
        lCommand::write("logged out successfully. bye.");
        $_SESSION["authorized"] = false;
    }
?>