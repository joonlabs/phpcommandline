<?php
    function resetMain($args, $command){
        lCommand::write("> $command");
        lCommand::write("session storage and command stack resetted successfully. this is now a clear session.");
        $_SESSION["phpcommandline"]["commandstack"] = [];
        $_SESSION["phpcommandline"]["storage"] = [];
    }
?>