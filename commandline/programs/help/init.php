<?php
    use PHPCommandLine\lCommand;

    function helpMain($args, $command){
        lCommand::write("> $command");
        $content = "pre-installed programs:\n";
        $dirs = array_filter(glob('programs/*'), 'is_dir');
        foreach($dirs as $i=>$s){
            $content .= " - ".str_replace("programs/", "", $s).(($i<count($dirs)-1) ? "\n" : "");
        }
        $content .= "\ncustom programs:\n";
        $dirs = array_filter(glob('../programs/*'), 'is_dir');
        foreach($dirs as $i=>$s){
            $content .= " - ".str_replace("../programs/", "", $s).(($i<count($dirs)-1) ? "\n" : "");
        }
        lCommand::write($content);    
    }
?>