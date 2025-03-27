<?php
// file     :   business/orderpizza.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------

Input::sanitizeOrderPOST();

// create an orderline if the number of pizzas ordered is not zero
// due to restrictions on post input field, this makes sure the number ordered is between 1 and 20
// if previous order for this pizza is already in the shopping cart, we will add this order to the already existing one
if ($_POST['numberofpizzas']) {
    // add number to existing orderline for this pizza if it exists
    $i = 0;
    while (isset($_SESSION['temporderlines'][$i])) {
        if ($_SESSION['temporderlines'][$i]['productID'] == $_SESSION['pizzaID']) {
            $_SESSION['temporderlines'][$i]['number'] += $_SESSION['numberofpizzas'];
            $i = -1;
        }
        $i++;
    }
    $_SESSION['tempOrderlines'][] = [
        'ID' => '', // set when writing to DB by autonumbering
        'orderID' => '', // not known until after order has been written to DB
        'productID' => $_SESSION['pizzaID'],
        'pizzaname' => $_SESSION['pizzaname'],
        'unitprice' => $_SESSION['unitprice'],
        'number' => $_SESSION['numberofpizzas']
    ];
}
