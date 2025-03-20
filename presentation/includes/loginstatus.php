<?php
// file     :   presentation/includes/loginstatus.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $_SESSION['login_status'] =  set to true when correctly registered, logged in, or temp credentials provided
// $_SESSION['login_msg'] =     message containing feedback info after login or registration
// $_COOKIE["PizzaPotente"] =   email address (username) of latest succesfull registration or login

$_SESSION['login_status'] = isset($_SESSION['login_status'])? $_SESSION['login_status'] : FALSE;
$_SESSION['login_msg'] = isset($_SESSION['login_msg'])? $_SESSION['login_msg'] : 'visiting as a guest';
?>

<div class='loginstatus'>
    <?php     
        $name = isset($_COOKIE['PizzaPotente'])? $_COOKIE['PizzaPotente'] : 'Guest';
        echo 'Hello ' . $name;
        echo '<br/>';
        echo $_SESSION['login_status']? 'logged in' : 'not logged in';
        echo '<br/>';
        echo $_SESSION['login_msg'] . '<br/>';
    ?>
</div>
