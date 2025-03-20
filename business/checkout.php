<?php
// file     :   business/checkout.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $_SESSION['login_status'] =      set to true when correctly registered, logged in, or temp credentials provided
// $ID =                            short var with local scope set to value of $_COOKIE['PizzaPotenteID']
//                                  only used for better code readability
// $_COOKIE['PizzaPotenteID'] =     ID of latest succesfull registration or login
// $ordertime =                     exact timestamp when checkout button was clicked. It is the date & time the order is placed
// $weekday =                       day of the week for today (1= monday, ..., 7 = sunday)
// $discount =                      discount percentage on total gross price (number between 0 - 100)
// $_SESSION['discountEligible'] =  set to TRUE if customer is eligible for discount (all registered customers are eligible)
// $orderdetails =                  list of orderdetails. Used to initialize a new Order object
// $order =                         object of class Order
// $line =                          1 particular orderline
// $orderlines =                    list of objects of class Orderline
// $_SESSION['tempOrderlines'] =    list of orderlines
// $_SESSION['msg'] =               the message in the lower right hand side of the page. Contains:
//                                  - a warning when the shopping cart is empty
//                                  - whether your order has been registered correctly
//                                  - at what time and date your order was placed


if ($_SESSION['login_status']) {
    // create an Order object
    $ID = $_COOKIE['PizzaPotenteID'];
    $ordertime = time();
    $weekday = date('N', $ordertime);
    // discount eligible users get all pizzas at 25% discount on wednesdays
    $discount = $_SESSION['discountEligible']? (($weekday == 3)? 25 : 0) : 0;
    $orderdetails = [
        // ID needs to be initialized for the construct to work, but will not be written to database. MySQL autoincrement will be used 
        'ID' => 'DUMMY',
        'customerID' => $ID,
        'discount' => $discount,
        'totalprice' => $_SESSION['totalprice'],
        'timeplaced' => $ordertime,
        'timedelivered' => 0,
        'delivered' => 0,
        'remarks' => filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING)
    ];
    $order = new Order($orderdetails);
    // create an Orderline object for each $_SESSION['tempOrderlines'] array
    unset($orderlines); // first unset it, just in case we have used it before
    if (isset($_SESSION['tempOrderlines'])) {
        $_SESSION['msg'] = 'Your order was placed on ' . date('Y-m-d H:i:s', $order -> getTimeplaced());
        foreach ($_SESSION['tempOrderlines'] as $key => $line) {
            if ($line) { $orderlines[] = new Orderline($line); }
        }
        // insert orderlines AND order object into the DB
        OrderDAO::placeOrder($order, $orderlines);
        // cleanup $_SESSION variables related to this order
        unset($_SESSION['tempOrderlines']);
    } else {
        $_SESSION['msg'] = 'ATTENTION!<br>Your shopping cart is empty.';
    }
} else {
    $_SESSION['msg'] = 'You need to be logged in before you can place orders.</br>'
                       . 'Please go to register/login page and register or log in.';
    header('location: index.php?display=browse');
}
