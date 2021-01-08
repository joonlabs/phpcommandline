<?php
    abstract class lCommand{
        static function addToStack($command){
            array_push($_SESSION["commandstack"], $command);
        }
        
        static function addToStackIfNotExists($command){
            if(!lCommand::existsCommandInStack($command)) lCommand::addToStack($command);
        }
        
        static function existsCommandInStack($command){
            foreach($_SESSION["commandstack"] as $c){
                $programm = explode(" ", $c)[0];
                if($programm==$command || $c==$command) return true;
            }
            return false;
        }
        
        static function getResult(){
            return $_SESSION["commandresult"];
        }
        
        static function write($result){
            $_SESSION["commandresult"] .= (strlen($_SESSION["commandresult"])==0 ? "" : "<br>").$result;
        }
        
        private static function popCommand(){
            $_SESSION["commandstack"] = array_slice($_SESSION["commandstack"], 1);
        } 
        
        private static function getCurrentCommand(){
            return count($_SESSION["commandstack"])>0 ? $_SESSION["commandstack"][0] : ""; 
        }     
        
        static function getNextItemAndPop(){
            $command = lCommand::getCurrentCommand();
            lCommand::popCommand();
            return $command;
        }
        
        static function performNextCommand(){
            $command = lCommand::getCurrentCommand();
            lCommand::popCommand();
            
            // determine command
            $splits = explode(" ",$command);
            $program = $splits[0];
            $args = array_slice($splits, 1);
            
            // call command
            if($command=="") return;
            if(lConnection::isAuthorized() or $program=="login"){
                if(file_exists("programms/$program/init.php")){
                    require_once("programms/$program/init.php");
                    $programmName = $program."Main";
                    $programmName($args, $command);
                }else{
                    lCommand::write("command \"$command\" not found");
                }                
            }else{
                lCommand::write("not authorized to run this command");
            }
        }        
    }
?>