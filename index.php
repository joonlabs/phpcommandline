<?php

?>

<html>
    <head>
        <title>Command Line</title>
        <meta charset="utf-8">
        <style>
            html, body{
                padding: 12px;
                background: #000;
                color: #fff;
                font-size: 16px !important; 
                font-family: "Menlo", "Raster Fonts", "Monospace"; 
            }
            
            #content{
                position: absolute;
                bottom: 50px;
            }
            
            textarea{
                float: right;
                outline: none;
                border: none;
                background: transparent;
                width: calc(100% - 15px);
                resize: none;
                color: #fff !important;
                font-size: 16px !important; 
                font-family: "Menlo", "Raster Fonts", "Monospace"; 
            }
            .input{
                position: absolute; 
                bottom: 16px;
            }
            .input span{
                line-height: 27px;   
            }
        </style>
        <script>
            class CommandLine{
                static parseCommand(event){
                    if(event.keyCode==13){
                        event.preventDefault();
                        CommandLine.sendCommand(event.srcElement.value)
                        event.srcElement.value = "";
                    }
                }
                static sendCommand(command){
                    let xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            let answer = JSON.parse(xhttp.responseText);
                            console.log(answer);
                            CommandLine.print(answer["return"]);
                        }
                    };
                    xhttp.open("GET", "commandline/?command="+encodeURI(command), true);
                    xhttp.send();
                }
                static print(content){
                    document.getElementById("content").innerHTML += "<br>"+content;
                }
            }
        </script>
    </head>
    <body onclick="document.getElementsByTagName('textarea')[0].focus();">
        <div id="content" class="content"></div>
        <div class="input"><span>$</span><textarea autofocus rows="1" onkeydown="CommandLine.parseCommand(event);"></textarea></div>
    </body>
</html>