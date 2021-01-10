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
                width: calc(100% - 48px);
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
                        CommandLine.historyindex = -1; 
                    }
                    if(event.keyCode==38){
                        event.preventDefault();
                        CommandLine.historyindex += 1;
                        CommandLine.historyindex = Math.min(CommandLine.historyindex, CommandLine.commandhistory.length -1 );
                        CommandLine.loadHistoryCommand();
                    }
                    if(event.keyCode==40){
                        event.preventDefault();
                        CommandLine.historyindex -= 1;
                        CommandLine.historyindex = Math.max(-1, CommandLine.historyindex);
                        CommandLine.loadHistoryCommand();
                    }
                    if(event.keyCode==9){
                        event.preventDefault();
                        CommandLine.getSuggestion();
                    }
                }
                static sendCommand(command, pushToStack=true){
                    if(command=="clear"){
                        CommandLine.reset()
                        return
                    }
                    if(pushToStack) CommandLine.commandhistory.unshift(command);
                    let xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            let answer = JSON.parse(xhttp.responseText);
                            console.log(answer);
                            CommandLine.print(answer["return"]);
                        }
                    };
                    xhttp.open("GET", "commandline/?command="+encodeURIComponent(command), true);
                    xhttp.send();
                }
                static print(content){
                    document.getElementById("content").innerHTML += "<br>"+content;
                }
                static reset(content){
                    document.getElementById("content").innerHTML = "";
                }
                static loadHistoryCommand(){
                    if(CommandLine.historyindex==-1) document.getElementsByTagName('textarea')[0].value = "";
                    else document.getElementsByTagName('textarea')[0].value = CommandLine.commandhistory[CommandLine.historyindex];
                    document.getElementsByTagName('textarea')[0].focus();
                    document.getElementsByTagName('textarea')[0].setSelectionRange(document.getElementsByTagName('textarea')[0].value.length,document.getElementsByTagName('textarea')[0].value.length);
                }
                static getSuggestion(){
                    let input = document.getElementsByTagName('textarea')[0].value
                    let xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            let answer = JSON.parse(xhttp.responseText);
                            console.log(answer);
                            if(answer["return"]!=null) document.getElementsByTagName('textarea')[0].value += answer["return"];
                        }
                    };
                    xhttp.open("GET", "commandline/autocomplete.php?input="+encodeURIComponent(input), true);
                    xhttp.send();}
            }
            CommandLine.commandhistory = []; 
            CommandLine.historyindex = -1; 
            CommandLine.sendCommand("init", false);
        </script>
    </head>
    <body ondblclick="document.getElementsByTagName('textarea')[0].focus();">
        <div id="content" class="content"></div>
        <div class="input"><span>$</span><textarea autocomplete="off" spellcheck="false" autofocus rows="1" onkeydown="CommandLine.parseCommand(event);"></textarea></div>
    </body>
</html>