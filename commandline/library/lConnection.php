<?php
    abstract class lConnection{
        static function init(){
            session_start();
            if(!isset($_SESSION["phpcommandline"])) $_SESSION["phpcommandline"] = [];
            $_SESSION["phpcommandline"]["commandresult"] = "";
            if(!isset($_SESSION["phpcommandline"]["authorized"])){
                $_SESSION["phpcommandline"]["authorized"] = false;
                $_SESSION["phpcommandline"]["commandstack"] = array();
                $_SESSION["phpcommandline"]["storage"] = array();
            }
        }
        
        static function isAuthorized(){
            return $_SESSION["phpcommandline"]["authorized"];
        }
        
        static function authorize($username, $password){
            $userfile = "users/$username.user";
            if(file_exists($userfile) and file_get_contents($userfile)==$password){
                $_SESSION["phpcommandline"]["authorized"] = true;
                return true;
            }
            return false;
        }
    }
?>