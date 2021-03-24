<?php
    namespace PHPCommandLine;

    abstract class lCommand{
        static function getAutoCompleteFor($input){
            $input = explode(" ", $input);
            $input = $input[count($input)-1];
            $all = [];
            // add programs
            $dirs = array_filter(glob('programs/*'), 'is_dir');
            foreach($dirs as $d){
                array_push($all, str_replace("programs/", "", $d));
            }
            // add custom programs
            $dirs = array_filter(glob('../programs/*'), 'is_dir');
            foreach($dirs as $d){
                array_push($all, str_replace("../programs/", "", $d));
            }
            // add files
            $pwd = lSystem::getPWD();
            $files = glob($pwd."/*");
            foreach($files as $f){
                array_push($all, basename($f));
            }
            asort($all);
            $candidates = [];
            foreach($all as $a){
                if(substr( $a, 0, strlen($input) ) == $input){
                    $candidates[] = str_replace($input, "", $a);
                }
            }
            if(count($candidates)>0){
                $suggestion = "";
                $smallestLengt = array_reduce($candidates, function($carry, $item){
                    return (strlen($item)<$carry or $carry===-1) ? strlen($item) : $carry;
                }, -1);
                $charAtPositionInAllSuggestionsSame = true;
                for($i=0; $i<$smallestLengt; $i++){
                    $charAtPosition = $candidates[0][$i];
                    foreach($candidates as $c){
                        if($c[$i]!==$charAtPosition) $charAtPositionInAllSuggestionsSame = false;
                    }
                    if(!$charAtPositionInAllSuggestionsSame){
                        return $suggestion;
                    }else{
                        $suggestion .= $charAtPosition;
                    }
                }
                return $suggestion;
            }
            return null;
        }
        static function addToStack($command){
            array_push($_SESSION["phpcommandline"]["commandstack"], $command);
        }
        static function setNextCommand($command){
            array_unshift($_SESSION["phpcommandline"]["commandstack"], $command);
        }
        
        static function addToStackIfNotExists($command){
            if(!lCommand::existsCommandInStack($command)) lCommand::addToStack($command);
        }
        
        static function existsCommandInStack($command){
            foreach($_SESSION["phpcommandline"]["commandstack"] as $c){
                $programm = explode(" ", $c)[0];
                if($programm==$command || $c==$command) return true;
            }
            return false;
        }
        
        static function getResult(){
            return $_SESSION["phpcommandline"]["commandresult"];
        }
        
        static function write($result){
            $_SESSION["phpcommandline"]["commandresult"] .= (strlen($_SESSION["phpcommandline"]["commandresult"])==0 ? "" : "\n").$result;
        }
        
        private static function popCommand(){
            $_SESSION["phpcommandline"]["commandstack"] = array_slice($_SESSION["phpcommandline"]["commandstack"], 1);
        } 
        
        private static function getCurrentCommand(){
            return count($_SESSION["phpcommandline"]["commandstack"])>0 ? $_SESSION["phpcommandline"]["commandstack"][0] : "";
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
                if(file_exists("programs/$program/init.php")){
                    // run pre installed program
                    require_once("programs/$program/init.php");
                    $programmName = str_replace("-","_", $program)."Main";
                    $programmName($args, $command);
                }else if(file_exists("../programs/$program/init.php")){
                    // run custom program
                    require_once("../programs/$program/init.php");
                    $programmName = str_replace("-","_", $program)."Main";
                    $programmName($args, $command);
                }else{
                    lCommand::write("command \"$command\" not found");
                }                
            }else{
                lCommand::write("> $command");
                lCommand::write("not authorized to run this command");
            }
        }        
    }
?>