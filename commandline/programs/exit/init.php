<?php
    use PHPCommandLine\lCommand;

    function exitMain($args, $command){
        lCommand::write("> $command");
        lCommand::write("note that exit is just an alias for logout");
        lCommand::setNextCommand("logout");
        lCommand::performNextCommand();
    }
?>