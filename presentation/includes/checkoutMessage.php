<?php
// file     :   business/checkoutMessage.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $_SESSION['msg'] =   the message in the lower right hand side of the page. Contains:
//                      - a warning when the shopping cart is empty
//                      - whether your order has been registered correctly
//                      - at what time and date your order was placed

if (isset($_SESSION['msg'])) {
    echo '<div class="message">';
    echo $_SESSION['msg'];
    echo '</div>';
    unset($_SESSION['msg']);
}

