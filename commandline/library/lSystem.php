<?php
abstract class lSystem{
    /*
     * returns the current directory
     */
    static function getPWD(){
        function str_replace_last( $search , $replace , $str ) {
            if( ( $pos = strrpos( $str , $search ) ) !== false ) {
                $search_length  = strlen( $search );
                $str    = substr_replace( $str , $replace , $pos , $search_length );
            }
            return $str;
        }

        $pwd = lStorage::get("pwd");
        if($pwd==null) $pwd = str_replace_last("/commandline", "", getcwd());
        lStorage::save("pwd", $pwd);
        return $pwd;
    }

    /*
     * changed the current directory
     */
    static function setPWD($pwd){
        lStorage::save("pwd", $pwd);
    }

    /*
     * returns the if a file exists
     */
    static function fileExists($file){
        return file_exists($file);
    }

    /*
     * returns the if a file exists
     */
    static function isFile($file){
        return is_file($file);
    }

    /*
     * returns the if a file exists
     */
    static function dirExists($dir){
        return is_dir($dir);
    }
}
?>