<!-- Include header -->
<?php include("header.php");?>

<div class="wrapper bgded overlay" style="background-image:url('images/sith_magic.png'); background-position: center; background-size: cover;">
  <div id="pageintro" class="hoc clear"> 

    <article>

      <h3 class="heading">Sith Login</h3>
      <?php
      require_once("auth.php");
      require_once("messages.php");

      if ($_SERVER['REQUEST_METHOD']=='POST'){

          if (isset($_POST['uname']) && isset($_POST['otp']) && isset($_POST['e']) && isset($_POST['id'])){
            if ($_POST['uname'] == 'admin' && $_POST['id'] != 1){

              form_message(1);
            }
            elseif(check_one_time_login($_POST['uname'],$_POST['otp'],$_POST['id'],$_POST['e'])){
              success_message();

            }
            else {

              form_message(1);
            }
          }

          elseif (isset($_POST['uname']) && isset($_POST['psw'])) {
              if (check_login($_POST['uname'],$_POST['psw'])) {
                  success_message();

              }
              else {
         
                form_message(2);
              }
          }

          else {

            form_message(3);

          }

      }
    
      elseif ($_SERVER['REQUEST_METHOD']==="GET"){
        form_message(3);

    }
    ?>
      
    </article>

  </div>
</div>

<!-- Include footer. -->
<?php include("footer.php");?>