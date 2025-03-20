<?php
// file     :   presentation/showform.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $_SESSION['form'] =          which of the 3 'faces' of the login/register form is shown
// $_GET['login'] =             retrieves the GET value indicating which link was clicked on the login/registration form
//                              i.e. which of the 3 types of form needs to be displayed (registration, temp registration or login)
// $_COOKIE['PizzaPotente'] =   email address (username) of latest succesfull registration or login

if (isset($_SESSION['form'])) {
    if (isset($_GET['login'])) {
        $_SESSION['form'] = filter_input(INPUT_GET, 'login', FILTER_SANITIZE_STRING);
    }
} else {
    $_SESSION['form'] = isset($_COOKIE['PizzaPotente'])? 'login' : 'register';
}
switch ($_SESSION['form']) {
    case 'registertemp':
        require 'presentation/includes/register.php';
        require 'presentation/includes/nologin.php';
        break;
    case 'login':
        require 'presentation/includes/noregister.php';
        require 'presentation/includes/login.php';
        break;
    default:
        require 'presentation/includes/register.php';
        require 'presentation/includes/login.php';
        break;
}
