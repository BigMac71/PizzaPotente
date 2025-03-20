<?php
// file     :   presentation/login.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $_POST['submit'] =   set when the registration/login form submit button is clicked
// $_SESSION['form'] =  which of the 3 'faces' of the login/register form is shown. Defaults to no. 1 (cfr. lines 42-44)

if (isset($_POST['submit'])) {
    switch ($_SESSION['form']) {
    case 'registertemp':
        require 'business/registertemp.php';
        break;
    case 'login':
        require 'business/userlogin.php';
        break;
    default:
        require 'business/register.php';
        break;
    }
}
?>

<!DOCTYPE html>
<html class='sepia'>

<head>
    <meta charset='UTF-8'>
    <title>Pizza Potente - login</title>
    <link rel='stylesheet' type='text/css' href='css/normalize.css'/>  
    <link rel='stylesheet' type='text/css' href='css/pizzapotente.css'/>
</head>

<body>
    <?php
        require_once 'presentation/includes/pageheader.php';
        require_once 'presentation/includes/loginstatus.php';
        
        // the registration/login form has two parts: the registration and the login part
        // each of these 3 links either disables or enables one or both of these parts, giving the customer 3 choices:
        // 1) registration AND login
        // 2) register temporary coordinates (do not provide username or password)
        // 3) login using previously registered account credentials (email and password)
    ?>
    <div class='login'>
        <h2>Registration / Login Form</h2>
        <div class='login_left'>
            <div class='linkButton'>
                &#10154;&nbsp;<a href='index.php?display=login&login=register'>register (create an account)</a>
            </div>
            <div class='linkButton'>
                &#10154;&nbsp;<a href='index.php?display=login&login=registertemp'>log in as guest (don't register)</a>
            </div>
            <div class='emptyspace'></div>
            <div class='linkButton'>
                &#10154;&nbsp;<a href='index.php?display=login&login=login'>login (I already have an account)</a>
            </div>
        </div>
        <?php require 'presentation/includes/showform.php'; ?>
    </div>
</body>

</html>
