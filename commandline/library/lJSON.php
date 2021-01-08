<?php
    abstract class lJSON{
        static function dump($object){
            echo json_encode([
                "return" => $object,
                "stack" => $_SESSION["commandstack"]
            ]);
        }
    }
?>