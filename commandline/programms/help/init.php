<?php
    function helpMain($args, $command){
        lCommand::write("> $command");    
        $content = "installed programs:<br>";
        $dirs = array_filter(glob('programms/*'), 'is_dir');
        foreach($dirs as $s){
            $content .= str_replace("programms/", "", $s)."<br>";
        }
        lCommand::write($content);    
    }
?>