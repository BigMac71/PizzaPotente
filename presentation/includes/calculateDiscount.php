<?php
// file     :   business/calculateDiscount.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $weekday =                       day of the week for today (1= monday, ..., 7 = sunday)
// $totalprice =                    total gross price for current shoppingcart
// $discountPct =                   discount percentage on total gross price (number between 0 - 100)
// $discount =                      absolute price discount in euros 
// $totalpriceWithDiscount =        total price after discount deduction
// $_SESSION['discountEligible'] =  set to TRUE if customer is eligible for discount (all registered customers are eligible)

$weekday = date('N', time());

// on wednesdays, customers eligible for discount get 25% discount on all pizzas
$discountPct = (($weekday == 3) AND $_SESSION['discountEligible'])? 25 : 0;
$discount = $totalprice * $discountPct / 100;
$totalpriceWithDiscount = $totalprice - $discount;