<?php

function form_message($failure){
        $fail_message="<h6>Incorrect UserName Password combo</h6>";

        $html_form = <<<'EOT'
        
                  <form action="index.php" method="POST">
                    <div class="container">
                      <input type="text" style="color:black;" placeholder="Enter Username" name="uname" required>
                  
                      <input type="password" style="color:black;" placeholder="Enter Password" name="psw" required>
                  
            
                    </div>
                    <button type="submit" style="color:black;">Login <i class="fas fa-angle-right"></i></button>
                  </form>
        EOT;

        if ($failure){
          echo $fail_message . $html_form;
        }
        else {
          echo $html_form;
        }
      }

function success_message($type){
    if ($type === 1){
        $html_login_success = <<< "EOT"
        <h6>login success</h6>
        <h6> User ID: 1</h6>
        <p> silicon{StromTroopersGottaEatToo} </p>
        EOT;

    }
    elseif ($type === 2){
        $html_login_success = <<< "EOT"
        <h6>login success</h6>
        <h6> User ID: 2</h6>
        <p> Welcome Trooper!<br>You are scheduled to patrol 5am-11am </p>
        EOT;
    }
    elseif ($type === 3){
      $html_login_success = <<< "EOT"
      <h6>login success</h6>
      <h6> User ID: 3</h6>
      <p> Welcome Trooper!<br>You are scheduled to patrol 12pm-5pm </p>
      EOT;
  }
  elseif ($type === 4){
    $html_login_success = <<< "EOT"
    <h6>login success</h6>
    <h6> User ID: 4</h6>
    <p> Welcome Trooper!<br>You are scheduled to patrol 5pm-5am </p>
    EOT;
}
    else{
        $html_login_success = <<< "EOT"
        <h6>login success</h6>
        <p> ERROR ID DOES NOT CORRESPOND WITH USER IN DATABASE </p>
        EOT;
    }
    

    echo $html_login_success;

}