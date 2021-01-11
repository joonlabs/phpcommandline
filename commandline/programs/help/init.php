<?php
    function helpMain($args, $command){
        lCommand::write("> $command");
        $content = "pre-installed programs:<br>";
        $dirs = array_filter(glob('programs/*'), 'is_dir');
        foreach($dirs as $i=>$s){
            $content .= " - ".str_replace("programs/", "", $s).(($i<count($dirs)-1) ? "<br>" : "");
        }
        $content .= "<br>custom programs:<br>";
        $dirs = array_filter(glob('../programs/*'), 'is_dir');
        foreach($dirs as $i=>$s){
            $content .= " - ".str_replace("../programs/", "", $s).(($i<count($dirs)-1) ? "<br>" : "");
        }
        lCommand::write($content);    
    }
?>