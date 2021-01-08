<?php
    abstract class lConnection{
        static function init(){
            session_start();
            $_SESSION["commandresult"] = "";
            if(!isset($_SESSION["authorized"])){
                $_SESSION["authorized"] = false;
                $_SESSION["commandstack"] = array();
                $_SESSION["storage"] = array();
            }
        }
        
        static function isAuthorized(){
            return $_SESSION["authorized"];   
        }
        
        static function authorize($username, $password){
            $userfile = "users/$username.user";
            if(file_exists($userfile) and file_get_contents($userfile)==$password){
                $_SESSION["authorized"] = true;
                return true;
            }
            return false;
        }
    }
?>