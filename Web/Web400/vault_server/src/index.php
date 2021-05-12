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
              echo "<h6>silicon{javascript_can_be_very_powerful}</h6>";
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


</script> -->
<?php

?>


<?php include("footer.php");?>