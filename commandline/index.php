<?php
    require 'library/init.php';
    use PHPCommandLine\lCommand;
    use PHPCommandLine\lConnection;
    use PHPCommandLine\lJSON;

    // set answer to json
    header("Content-Type: text/json;");

    lConnection::init();

    $command = (isset($_GET["command"]) and $_GET["command"]!="") ? trim($_GET["command"]) : null;
    if($command!=null){
        if($command=="init"){
            if(!lConnection::isAuthorized()) lCommand::write("welcome to the php command line. please login via the command \"login\"");
        }else{
            lCommand::addToStack($command);
        }
    }

    lCommand::performNextCommand();

    lJSON::dump(lCommand::getResult());
?>