<?php
// file     :   business/register.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------

Input::sanitizeRegisterPOST();
Input::sanitizeLoginPOST();

// a customer is eligible for discount as soon as he/she registers
$customer = new Customer($_SESSION);
if (CustomerDAO::accountExists($customer -> getEmail())) {
    $_SESSION['login_status'] = FALSE;
    $_SESSION['login_msg'] = 'ERROR! Account already exists.';
    header('location: index.php?display=login&login=login');
} else {
    try {
        $customer -> setDiscountEligible(TRUE);
        CustomerDAO::registerCustomer($customer);
    } catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), 'n';
    }
    $_SESSION['discountEligible'] = TRUE;
    $_SESSION['login_status'] = TRUE;
    $_SESSION['login_msg'] = 'You are now registered.';
    header('location: index.php?display=browse');
}
