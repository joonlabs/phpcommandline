<?php
    use PHPCommandLine\lCommand;
    use PHPCommandLine\lSystem;

    function lsMain($args, $command){
        lCommand::write("> $command");
        $files = scandir(lSystem::getPWD());
        foreach($files as $f){
            if($f!="." and $f!="..") lCommand::write("$f");
        }
    }
?>