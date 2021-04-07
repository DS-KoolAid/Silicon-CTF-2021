<!DOCTYPE html>
<!--
Template Name: Wavefire
Author: <a href="https://www.os-templates.com/">OS Templates</a>
Author URI: https://www.os-templates.com/
Copyright: OS-Templates.com
Licence: Free to use under our free template licence terms
Licence URI: https://www.os-templates.com/template-terms
-->
<html lang="en">

<head>
<title>Empire Employee Portal</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row0">
  <header id="header" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="one_quarter first">
      <h1><a href="../index.html"><span>G</span>alactic<span>E</span>mpire</h1>
    </div>
    <div class="three_quarter">
      <ul class="nospace clear">
        <li class="one_third first">
          <div class="block clear"><a href="#"><i class="fas fa-phone"></i></a> <span><strong>Give us a call:</strong> +00 (123) 456 7890</span></div>
        </li>
        <li class="one_third">
          <div class="block clear"><a href="#"><i class="fas fa-envelope"></i></a> <span><strong>Send us a mail:</strong> support@empire.site</span></div>
        </li>
        <li class="one_third">
          <div class="block clear"><a href="#"><i class="fas fa-clock"></i></a> <span><strong> Mon. - Fri.:</strong> 08.00am - 18.00pm</span></div>
        </li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </header>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <section class="hoc clear"> 
    <!-- ################################################################################################ -->
    <nav id="mainav">
      <ul class="clear">
        <li class="active"><a href="../index.html">Home</a></li>
        <li><a class="drop" href="#">Pages</a>
          <ul>
            <li><a href="login.php">Login</a></li>
            <li><a href="gallery.html">Gallery</a></li>

          </ul>
        </li>

    </nav>
    <!-- ################################################################################################ -->

    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper bgded overlay" style="background-image:url('../images/empire_flag.png'); background-position: center;">
  <div id="pageintro" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <article>
      <!-- <p>Mauris placerat sem hendrerit</p> -->
      <h3 class="heading">Empire Employee Portal</h3>
      <?php
      if ($_SERVER['REQUEST_METHOD']=='POST'){
          $name = $_POST["uname"];
          $secret = $_POST["psw"];

          if (isset($name) && $name !== "" && isset($secret) && $secret !== "") {
              if ($name === "tc_174812" and $secret === "3f3f85v3da") {
                  echo <<< HERE
                  <h6>flag{B0rN_70_8E_R3b3ls}</h6>
                  HERE;
              }
              else {
                echo <<< HERE
                <h6>Incorrect UserName Password combo</h6>
                <form action="login.php" method="POST">
                  <div class="container">
                    <input type="text" style="color:black;" placeholder="Enter Username" name="uname" required>
                
                    <input type="password" style="color:black;" placeholder="Enter Password" name="psw" required>
                
          
                  </div>
                  <button type="submit" style="color:black;">Login <i class="fas fa-angle-right"></i></button>
                </form>
                <!-- <p>Empire Employee Portal</p> -->
                HERE;
              }
          }
          else {
              echo <<< HERE
              <h6>Incorrect UserName Password combo</h6>
              <form action="login.php" method="POST">
                <div class="container">
                  <input type="text" style="color:black;" placeholder="Enter Username" name="uname" required>
              
                  <input type="password" style="color:black;" placeholder="Enter Password" name="psw" required>
              
         
                </div>
                <button type="submit" style="color:black;">Login <i class="fas fa-angle-right"></i></button>
              </form>
              <!-- <p>Empire Employee Portal</p> -->
              HERE;

          }

      }
    
      elseif ($_SERVER['REQUEST_METHOD']==="GET"){
        echo <<< HERE
        <form action="login.php" method="POST">
          <div class="container">
            <input type="text" style="color:black;" placeholder="Enter Username" name="uname" required>
        
            <input type="password" style="color:black;" placeholder="Enter Password" name="psw" required>
        
   
          </div>
          <button type="submit" style="color:black;">Login <i class="fas fa-angle-right"></i></button>
        </form>
        <!-- <p>Empire Employee Portal</p> -->
        HERE;

    }
    ?>
      
    </article>
    <!-- ################################################################################################ -->
  </div>
</div>



<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="one_third first">
      <h6 class="heading">Remember...</h6>
      <p>We are watching...</p>
    </div>

    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">empire.site</a></p>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>