<?php
    function updateMain($args, $command){
        if(count($args)==0){
            lCommand::write("> $command");
            lCommand::write("are you sure that you want to override the current version of php command line (".lSystem::getVersion().") with the update? [y/n]");
            lCommand::addToStack("update -waitforconfirmation");
        }else if(count($args)==1){
            if($args[0]=="-waitforconfirmation") {
                $answer = lCommand::getNextItemAndPop();
                if($answer=="y" or $answer=="yes"){
                    lCommand::write("downloading update from github...");
                    $success = download_update();
                    if($success){
                        $success = install_update();
                        if($success){
                            lCommand::write("update sucessfully installed");
                        }else{
                            lCommand::write("cannot extract update. make sure that the php zip extension is installed and the script has the according permissions.");
                        }
                    }else{
                        lCommand::write("cannot download update. make sure that php can download files from https://github.com/.");
                    }
                }else if($answer=="n" or $answer=="no"){
                    lCommand::write("update canceled");
                }else{
                    lCommand::write("please answer with \"y\" (yes) or \"n\" (no). proceed with the update? [y/n]");
                    lCommand::addToStack("update -waitforconfirmation");
                }
            }else{
                lCommand::write("unknwon sub command");
            }
        }
    }

    function download_update(){
        $downloadUrl = "https://github.com/joonlabs/phpcommandline/archive/master.zip";
        $writtenBytes = file_put_contents("../update.zip",file_get_contents($downloadUrl));
        return $writtenBytes>0;
    }

    function install_update(){
        $file = '../update.zip';
        $zip = new ZipArchive;
        $res = $zip->open($file);
        if ($res === TRUE) {
            $zip->extractTo('../');
            $zip->close();
            unlink($file);
            rcopy("../phpcommandline-master", "..");
            rrmdir("../phpcommandline-master");
            return true;
        } else {
            unlink($file);
            return false;
        }
    }

    function rcopy($src, $dst) {
        if (file_exists ( $dst ))
            if($dst!=".." and $dst!="../programs") rrmdir ( $dst ); // do not remove custom programs
        if (is_dir ( $src )) {
            if($dst!="..") mkdir ( $dst );
            $files = scandir ( $src );
            foreach ( $files as $file )
                if ($file != "." && $file != "..")
                    rcopy ( "$src/$file", "$dst/$file" );
        } else if (file_exists ( $src ))
            copy ( $src, $dst );
    }

    function rrmdir($dir) {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file)
                if ($file != "." && $file != "..") rrmdir("$dir/$file");
            rmdir($dir);
        }
        else if (file_exists($dir)) unlink($dir);
    }
?>