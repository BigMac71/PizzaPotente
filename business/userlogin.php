<?php
// file     :   business/userlogin.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------

Input::sanitizeLoginPOST();

$loginresult = CustomerDAO::checkLogin($_SESSION['email'], $_SESSION['password']);
$_SESSION['login_status'] = $loginresult[0];
$_SESSION['login_msg'] = $loginresult[1];
if ($_SESSION['login_status']) {
    // customer data is read from DB, based on email
    $customerID = CustomerDAO::findCustomerID($_SESSION['email']);
    $customer = new Customer(CustomerDAO::getCustomerData($customerID));
    $_SESSION['discountEligible'] = $customer -> getDiscountEligible();
    header('location: index.php?display=browse');
} else {
    header('location: index.php?display=login&login=login');
}
