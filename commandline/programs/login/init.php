<?php
    function loginMain($args, $command){
        if(count($args)==0){
            lCommand::write("> login");
            lCommand::write("username?");
            lCommand::addToStack("login -waitforusername");
        }
        if(count($args)==1){
            if($args[0]=="-waitforusername"){
                $username = lCommand::getNextItemAndPop();
                lStorage::save("username", $username);
                lCommand::write("password?");
                lCommand::addToStack("login -waitforpassword");
            }
            else if($args[0]=="-waitforpassword"){
                $password = lCommand::getNextItemAndPop();
                $username = lStorage::get("username");
                if(lConnection::authorize($username, $password)){
                    lCommand::write("welcome, ".$username);
                }else{
                    lCommand::write("not authorized");
//                    lCommand::addToStack("login");
//                    lCommand::performNextCommand();
                }
            }            
        }
        
    }
?>