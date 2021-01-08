<?php
    abstract class lStorage{
        static $program = ".main";
        
        static function save($key, $value){
            if(!isset($_SESSION["storage"][lStorage::$program])) $_SESSION["storage"][lStorage::$program] = [];
            $_SESSION["storage"][lStorage::$program][$key] = $value;
        }
        
        static function get($key){
            return $_SESSION["storage"][lStorage::$program][$key];
        }
    }
?>