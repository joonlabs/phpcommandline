<?php
    use PHPCommandLine\lCommand;

    function echoMain($args, $command){
        lCommand::write("> $command");
        $str = "";
        foreach($args as $a) $str.= "$a ";
        lCommand::write($str);
    }
?>