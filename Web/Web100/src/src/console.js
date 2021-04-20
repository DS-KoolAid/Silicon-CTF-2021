
$('#test').hide();
setTimeout(function() { 
    $('#loading').fadeOut();
    $('#test').show();
    
}, 5000);

$('#test').terminal({
    hello: function(what) {
        this.echo('Hello, ' + what +
                  '. Wellcome to this terminal.');
    },
    ls: function(){
        this.echo("No no no, this isn't a real shell...");
    },
    whoami: function(){
        this.echo("Who am i? Who are you?");
    },
    nc: function(){
        this.echo("No no no, this isn't a real shell...");
    },
    python: function(){
        this.echo("No no no, this isn't a real shell...");
    },
    pwd: function(){
        this.echo("No no no, this isn't a real shell...");
    },
    pew: function(){
     
        this.echo("(　-_･)σ - - - - - - - - ･");
    },
    test: function(test){
        this.echo(check_secret(test));
    },
    get_flag: function(secret){
        if (!check_secret(secret)){
            this.echo("Not that easy!");
        }
        else{
            this.echo(query_flag());
        }
    },
    self_destruct: function(){
        this.hide();
    }
}, {
    greetings: `Welcome to the Tie-Fighter Online Terminal! 

    _                                            _
    T T                                          T T
    | |                                          | |
    | |                                          | |
    | |                                          | |
    | |                                          | |
    | |                                          | |
    | |                                          | |
    | |                   ____                   | |
    | |            ___.r-"'--'"-r.____           | |
    | |.-._,.,---~"_/_/  .----.  \\_\\_"~---,.,_,-.| |
    | ]|.[_]_ T~T[_.-Y  / \\  / \\  Y-._]T~T _[_].|| |
   [|-+[  ___]| [__  |-=[--()--]=-|  __] |[___  ]+-|]
    | ]|"[_]  l_j[_"-l  \\ /  \\ /  !-"_]l_j  [_]~|| |
    | |'-' "~"---.,_\\"\\  "o--o"  /"/_,.---"~" '-'| |
    | |             ~~"^-.____.-^"~~             | |
    | |                                          | |
    | |                                          | |
    | |                                          | |
    | |                                          | |
    | |                                          | |
    | |                                          | |
    | |                                          | |
    l_i                                          l_j 

This is a special terminal that is a little different than normal terminals. 

It has been specifically designed for system management.`,
    prompt: 'ts> ',
    name: 'TieFighterTerm'
});

function check_secret(plain_text){
        var encrypted = CryptoJS.AES.encrypt(plain_text,"Xt*gz8V3FJVknY_xvco");
        var endpoint = '/check_secret.php';
        var pre_body="secret=";
        var body = pre_body.concat(encrypted.toString());
        var request = new XMLHttpRequest();
        request.open('POST',endpoint,false);
        request.send(body);
        if (request.status === 200){
            console.log(request.responseText);
        }
        else{
            console.log(request.status);
        }
}

function query_flag(){
    var request = new XMLHttpRequest();
    var endpoint = '/query_flag.php?auth=1';
    request.open('GET',endpoint,false);
    request.send(null);
    if (request.status === 200){
        return request.responseText;
    }
    else{
        return 'There has been an error with the backend. Please contact an admin'
    }

}