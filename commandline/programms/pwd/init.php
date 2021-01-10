<?php
    function pwdMain($args, $command){
        lCommand::write("> $command");
        $pwd = lSystem::getPWD();
        lCommand::write("$pwd");
    }

    function str_replace_last( $search , $replace , $str ) {
        if( ( $pos = strrpos( $str , $search ) ) !== false ) {
            $search_length  = strlen( $search );
            $str    = substr_replace( $str , $replace , $pos , $search_length );
        }
        return $str;
    }
?>