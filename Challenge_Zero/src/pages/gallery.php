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
            <li><a href="gallery.php">Gallery</a></li>
          </ul>
        </li>

    </nav>
    <!-- ################################################################################################ -->

    <!-- ################################################################################################ -->
  </section>
</div>
<!-- TODO: Sanitize user input on search box for gallery page. See OWASP A1 -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper bgded overlay" style="background-image:url('../images/empire_flag.png'); background-position: center;">
  <div id="breadcrumb" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <h6 class="heading">Gallery</h6>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content"> 
      <!-- ################################################################################################ -->
      <div id="gallery">
        <figure>
          <header class="heading">Gallery</header>
          <form action="" method="post">
          <?php 
            $search_value=$_POST["search"];
            echo '<input type="text" name="search" value="'.$search_value.'">';
          ?>
          <input type="submit" name="submit" value="Search by Post ID">
          </form>
          <br/>
          <?php
            $con=new mysqli('mysql-server_c0', 'root', '3Yex8b76FzCeYCvqTd8c', 'c0');
            if($con->connect_error) {
              echo 'Connection Failed: '.$con->connect_error;
            } else {
              $sql="select * from pages where is_draft=0";
              if(isset($search_value) && !empty($search_value)) {
                $sql = "$sql and page_id=$search_value";
              }

              $res=$con->query($sql);
              if(!$res) {
                echo '<p style="color:red">Error with query: '.$sql.'</p>';
              } else {
                echo '<table class="nospace">';
                echo '<tr><th>Page ID</th><th>Page Link</th><th>Page Name</th><th>Page Thumbnail</th></tr>';

                while($row=$res->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>'.$row["page_id"].'</td>';
                    echo '<td><a href="'.$row["page_uri"].'">Link to page - '.$row["page_uri"].'</a></td>';
                    echo '<td>'.$row["page_title"].'</td>';
                    echo '<td><img style="width:500px" src="../images/'.$row["page_thumbnail"].'" alt=""><br/>'.$row["page_thumbnail"].'</td>';
                    echo '</tr>';
                }
                echo '</table>';
              }
            }
          ?>
          <!-- <ul class="nospace clear">
            <li class="one_quarter first"><a href="tie_fighter_speed.html"><img src="../images/tf.png" alt=""></a>Tie Fighters</li>
            <li class="one_quarter"><a href="storm_trooper_sharp_shooter.html"><img src="../images/st.png" alt=""></a>Storm Trooper Accuracy</li>
            <li class="one_quarter"><a href="death_star_reborn.html"><img src="../images/deathstar.jpeg" alt=""></a>Death Star Reborn</li>

          </ul> -->
        </figure>
      </div>
      <!-- ################################################################################################ -->

      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
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
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>