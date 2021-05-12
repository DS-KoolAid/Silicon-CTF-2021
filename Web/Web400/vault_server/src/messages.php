<?php

function form_message($failure){
        $fail_message="<h6>Password Incorrect</h6>";

        $html_form = <<<'EOT'
        
                  <form action="index.php" method="POST">
                    <div class="container">
                  
                      <input type="password" style="color:black;" placeholder="Enter Password" name="password_field" required>
                  
            
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
