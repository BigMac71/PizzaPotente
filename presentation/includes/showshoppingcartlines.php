<?php
//  file    :   presentation/includes/showshoppingcartlines.php
//  author  :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $totalprice =                    total gross price for current shoppingcart
// $totalnumber =                   total number of pizzas in shoppingcart
// $_SESSION['tempOrderlines'] =    list of orderlines
// $orderline =                     order of a number of 1 particular kind of pizza 
// $_SESSION['totalprice'] =        keep totalprice in session variable for checkout

$totalprice = $totalnumber = 0;
if (isset($_SESSION['tempOrderlines'])) {    
    foreach ($_SESSION['tempOrderlines'] as $key => $orderline) {
        if ($orderline) {
            echo '<tr>';
            echo '<td>' . $orderline['pizzaname'] . '</td>';
            echo '<td class="tablenumber">' . $orderline['number'] . '</td>';
            echo '<td class="tablenumber">' . $orderline['unitprice'] . ' €' . '</td>';
            echo '<td class="cancel"><a href="index.php?display=browse&cancel=' . $key . '"><b>x</b></a></td>';
            echo '</tr>';
            $totalprice += $orderline['number'] * $orderline['unitprice'];
            $totalnumber += $orderline['number'];
        }
    }
    $_SESSION['totalprice'] = $totalprice;
}
