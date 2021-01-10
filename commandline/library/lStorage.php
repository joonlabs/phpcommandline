<?php
    abstract class lStorage{
        static $program = ".main";
        
        static function save($key, $value){
            if(!isset($_SESSION["phpcommandline"]["storage"][lStorage::$program])) $_SESSION["phpcommandline"]["storage"][lStorage::$program] = [];
            $_SESSION["phpcommandline"]["storage"][lStorage::$program][$key] = $value;
        }
        
        static function get($key){
            if(isset($_SESSION["phpcommandline"]["storage"][lStorage::$program])){
                return $_SESSION["phpcommandline"]["storage"][lStorage::$program][$key];
            }
            return null;
        }
    }
?>