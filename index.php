<?php
// file     :   index.php
// author   :   sven.croon
// test test test

// variables:
// -----------------------------------------------------------------------------
// $_GET['display'] =   set to the name of the web page we are visiting:
// there are 4 pages:
// 'home'               is the landing page.
// 'about'              contains some text info and a Google Maps section
// 'browse'             allows visitors to browse the pizzas and place orders
// 'login/register'     is self-explanatory

require_once 'data/includes.php';
session_start();
$page = isset($_GET['display'])? filter_input(INPUT_GET, 'display', FILTER_SANITIZE_STRING) : 'home';
switch ($page) {
    case 'about':
        require_once 'presentation/about.php';
        break;
    case 'browse':
        require_once 'presentation/browse.php';
        break;
    case 'login':
        require_once 'presentation/login.php';
        break;
    default:
        require_once 'presentation/home.php';
        break;
}

