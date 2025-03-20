<?php
//  file    :   presentation/includes/deliveryAddress.php
//  author  :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $customerID =                set to customer ID if login status is TRUE
// $_SESSION['login_status'] =  set to true when correctly registered, logged in, or temp credentials provided
// $_COOKIE['PizzaPotenteID'] = customer ID when login status is TRUE
// $coordinates =               set to customer coordinates when login status is TRUE
// $location =                  zipcode and city info based on locationID

$customerID = $_SESSION['login_status']? $_COOKIE['PizzaPotenteID'] : null;

if ($customerID) {
    $coordinates = CustomerDAO::getCustomerData($customerID);
    $location = citiesDAO::getLocationInfo($coordinates['locationID']);
    $coordinates += $location;
    echo $coordinates['firstname'] . ' ' . $coordinates['surname'] . '</br>';
    echo $coordinates['street'] . ', ' . $coordinates['housenumber'] . '</br>';
    echo $coordinates['zipcode'] . ' ' . $coordinates['name'] . '</br>';
    echo $coordinates['phone'];
} else {
    echo 'No address data.</br>';
    echo 'Please login or register before checking out.';
}

