<?php
use PHPCommandLine\lCommand;
use PHPCommandLine\lSystem;

function versionMain($args, $command){
    lCommand::write("> $command");
    $version = lSystem::getVersion();
    lCommand::write("v$version");
}
?>