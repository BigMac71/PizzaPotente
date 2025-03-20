<?php
// file     :   business/registertemp.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------

Input::sanitizeRegisterPOST();

// a customer is not eligible for discount when ordering with temp coordinates
$_SESSION['discountEligible'] = FALSE;
$customer = new Customer($_SESSION);
$_SESSION['login_status'] = TRUE;
$_SESION['login_msg'] = 'You are logged in as guest.';
CustomerDAO::registerTempCustomer($customer);
header('location: index.php?display=browse');
