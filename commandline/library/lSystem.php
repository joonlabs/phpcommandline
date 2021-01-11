<?php
abstract class lSystem{
    static private $version = "0.1";

    /*
     * returns the current version
     */
    public static function getVersion()
    {
        return lSystem::$version;
    }

    /*
     * returns the current directory
     */
    static function getPWD(){
        // replace last occurrence
        $str = getcwd();
        $search = "/commandline";
        $replace = "";
        if( ( $pos = strrpos( $str , $search ) ) !== false ) {
            $search_length = strlen( $search );
            $str = substr_replace( $str , $replace , $pos , $search_length );
        }

        $pwd = lStorage::get("pwd");
        if($pwd==null) $pwd = $str;
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