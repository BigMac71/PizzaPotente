<?php
// file     :   business/cancelpizza.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $_SESSION['tempOrderlines'] =    list of orderlines
// $_GET['cancel'] =                set to productID when the resp. pizza's cancel cross in the shopping cart is clicked

$_SESSION['tempOrderlines'][$_GET['cancel']] = null;
unset($_GET['cancel']);
