<?php 

if ($_SERVER['REQUEST_METHOD']=='GET'){

    if (isset($_GET['auth'])){
        $auth = $_GET['auth'];
        if ($auth === '1'){
            echo 'silicon{TheRebelsDontStandAChance!}';
        }
    }


}

