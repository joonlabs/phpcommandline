<?php
    use PHPCommandLine\lCommand;
    use PHPCommandLine\lSystem;

    function pwdMain($args, $command){
        lCommand::write("> $command");
        $pwd = lSystem::getPWD();
        lCommand::write("$pwd");
    }
?>