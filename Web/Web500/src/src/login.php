<!-- Include header -->
<?php include("header.php");?>

<div class="wrapper bgded overlay" style="background-image:url('../images/empire_flag.png'); background-position: center;">
  <div id="pageintro" class="hoc clear"> 

    <article>

      <h3 class="heading">Death Star Login</h3>
      <?php
      require_once("auth.php");
      require_once("messages.php");

      if ($_SERVER['REQUEST_METHOD']=='POST'){
          $uname = $_POST["uname"];
          $psw = $_POST["psw"];
          $otp = $_POST["otp"];

          if (isset($uname) && $uname !== "" && isset($psw) && $psw !== "") {
              if (check_login($uname,$psw)) {
                  success_message();
              }
              else {
                form_message(true);
              }
          }
          elseif (isset($uname) && $uname !== "" && isset($otp) && $otp !== ""){
            if(check_one_time_login($uname,$otp)){
              success_message();

            }
            else {
              form_message(true);
            }
          }
          else {
            form_message(false);

          }

      }
    
      elseif ($_SERVER['REQUEST_METHOD']==="GET"){
        form_message(false);

    }
    ?>
      
    </article>

  </div>
</div>

<!-- Include footer. -->
<?php include("footer.php");?>