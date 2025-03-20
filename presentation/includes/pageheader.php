<?php
// file     :   presentation/includes/pageheader.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
?>

<h1 class='pageTitle'>Pizza Potente</h1>

<?php
    $loginStatus = isset($_SESSION['login_status'])? $_SESSION['login_status'] : FALSE;
    if ($loginStatus) {
        require_once 'logoutButton.php';
    } else {
        require_once 'landingPageButton.php';
    }
?>
<div class='menuBar'>
    <a href='index.php?display=about'>About Us</a>
    <a href='index.php?display=browse'>Our Powerful Pizzas</a>
    <a href='index.php?display=login'>Login / Register</a>
</div>
