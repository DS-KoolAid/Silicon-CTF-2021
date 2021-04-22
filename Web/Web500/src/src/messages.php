<?php

require_once("db.php");
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

function success_message(){
    $flag = load_flag();
    $html_login_success = <<< "EOT"
    <h6>login success</h6>
    <p> "$flag" </p>
    EOT;

    echo $html_login_success;

}