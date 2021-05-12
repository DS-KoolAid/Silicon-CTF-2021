<!-- Include header -->
<?php include("header.php");?>

<div class="wrapper bgded overlay" style="background-image:url('../images/banner.jpeg'); background-position: center; background-size: cover;">
  <div id="pageintro" class="hoc clear"> 

    <article>

      <h3 class="heading">Sith Login</h3>
      <?php
      require_once("auth.php");
      require_once("messages.php");

      if ($_SERVER['REQUEST_METHOD']=='POST'){

        if (!isset($_POST['id']) && isset($_POST['uname'])){
            if ($_POST['uname']==="temp_login"){
                $_POST['id'] = 2;
            }
        }

          if (isset($_POST['uname']) && isset($_POST['psw']) && isset($_POST['id'])) {
              if (check_login($_POST['uname'],$_POST['psw'])) {
                  $id_num=intval($_POST['id']);
                  if ($id_num === 1){
                    success_message(1);
                  }
                  elseif ($id_num === 2){
                      success_message(2);
                  }
                  else{
                      success_message(3);
                  }

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