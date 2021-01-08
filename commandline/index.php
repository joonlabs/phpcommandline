<?php
require 'library/init.php';
header("Content-Type: text/json;");

lConnection::init();

$command = (isset($_GET["command"]) and $_GET["command"]!="") ? trim($_GET["command"]) : null;
if($command!=null){
    lCommand::addToStack($command);
}
if(!lConnection::isAuthorized()){
    lCommand::addToStackIfNotExists("login");
}

lCommand::performNextCommand();

lJSON::dump(lCommand::getResult());
?>