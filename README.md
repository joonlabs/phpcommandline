# phpcommandline
A web command line interface, that can run php programs on server side. It provides basic username and password authentication.
You can build you own, or link your existing programs to this browser based command line to run them from your browser. 

## install
Clone or download the repository and place it inside the folder on the server from where you want to use it - e.g. /myphpcommandline/.

## setup
When installed, the tool does not provide any logins. However you can simply add one by placing a "username.user" file in the /commandline/user/ folder with the password of this user as file content.

## usage
once followed the steps above, simply open the url of the directory in a browser and type ```login```. You can now login with the username and password created above.  

## preinstalled programs:
- echo
- help
- login
- logout
- reset

## building own programs
you can build (or link) your own programs by creating a dir in the /commandline/programs/ with the name of you program. This dir should countain a init.php file with a method named after following scheme: 

```php
function [yourprogramname]Main($args, $command) {
  lCommand::write("> $command");
}
```

where ```$args``` is an array of strings, containing all aditional arguments provided to this function and ```$command``` is the whole command that was called.
You can write a line to the output by calling ```lCommand::write("CONTENT");```
