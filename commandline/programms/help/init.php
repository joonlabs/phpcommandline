<?php
    function helpMain($args, $command){
        lCommand::write("> $command");    
        $content = "installed programs:<br>";
        $dirs = array_filter(glob('programms/*'), 'is_dir');
        foreach($dirs as $i=>$s){
            $content .= " - ".str_replace("programms/", "", $s).(($i<count($dirs)-1) ? "<br>" : "");
        }
        lCommand::write($content);    
    }
?>