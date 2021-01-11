<?php
    require 'library/init.php';
    use PHPCommandLine\lCommand;
    use PHPCommandLine\lConnection;
    use PHPCommandLine\lJSON;

    // set answer to json
    header("Content-Type: text/json;");

    lConnection::init();

    $input = (isset($_GET["input"]) and $_GET["input"]!="") ? trim($_GET["input"]) : null;
    if(lConnection::isAuthorized()){
        lJSON::dump(lCommand::getAutoCompleteFor($input));
    }else{
        lJSON::dump(str_replace($input, "", "login"));
    }

?>