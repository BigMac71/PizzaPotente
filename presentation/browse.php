<?php
// file     :   presentation/browse.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $_GET['orderpizza'] =        set to productID when the resp. pizza's [order] button is clicked
// $_GET['cancel'] =            set to productID when the resp. pizza's cancel cross in the shopping cart is clicked
// $_GET['checkout'] =          set to TRUE when the shopping cart's [checkout] button is clicked
// $totalnumber =               total number of pizzas in shoppingcart
// $totalprice =                total gross price for current shoppingcart
// $discountPct =               discount percentage on total gross price (number between 0 - 100)
// $discount =                  absolute price discount in euros 
// $totalpriceWithDiscount =    total price after discount deduction

// pizza has been added to shopping cart
if (isset($_GET['orderpizza']) AND $_GET['orderpizza']) {
    require_once 'business/orderpizza.php';
}
// pizza has been removed from shoppingcart
if (isset($_GET['cancel'])) {
    require_once 'business/cancelpizza.php';
}
// checkout
if (isset($_GET['checkout']) AND $_GET['checkout']) {
    require_once 'business/checkout.php';
}
?>

<!DOCTYPE html>
<html class='sepia'>

<head>
    <meta charset='UTF-8'>
    <title>Pizza Potente - browse</title>
    <link rel='stylesheet' type='text/css' href='css/normalize.css'/>  
    <link rel='stylesheet' type='text/css' href='css/pizzapotente.css'/>
</head>

<body>
    <?php
        require_once 'presentation/includes/pageheader.php';
        require_once 'presentation/includes/loginstatus.php';
    ?>
    <div class='browseproducts'>
        <?php require_once 'presentation/includes/showpizzas.php'; ?>
    </div>
    <div class='shoppingcart'>
        <table>
            <caption><h2 id='shoppingcartcaption'>Shopping Cart</h2></caption>
            <tr>
                <th>pizza</th>
                <th>count</th> 
                <th class='tablenumber'>unit price</th>
                <th>cancel</th>
            </tr>
            <?php require_once 'presentation/includes/showshoppingcartlines.php'; ?>                  
            <tr class='thick_border_top'>
                <td class='smallcaps'><b>total:</b></td>
                <td class='tablenumber'><?php echo $totalnumber; ?></td>
                <td class='tablenumber'><?php echo number_format((float)$totalprice, 2, '.', '') . ' €'; ?></td>
                <td></td>
            </tr>
            <?php require_once 'presentation/includes/calculateDiscount.php'; ?>
            <tr>
                <td class='smallcaps'><b>discount:</b></td>
                <td class='tablenumber'><?php echo $discountPct . '%'; ?></td>
                <td class='tablenumber'><?php echo number_format((float)$discount, 2, '.', '') . ' €'; ?></td>
                <td></td>
            </tr>
            <tr>
                <td class='smallcaps'><b>TOTAL (with discount):</b></td>
                <td class='tablenumber'></td>
                <td class='tablenumber'><b><?php echo number_format((float)$totalpriceWithDiscount, 2, '.', '') . ' €'; ?></b></td>
                <td></td>
            </tr>            
        </table>
        <form action='index.php?display=browse&checkout=true' method='post'>
            <textarea class='remarks' name='remarks' placeholder='additional remarks for the delivery courier'></textarea>
            <input type='submit' class='orderButton' value='CheckOut'/>
        </form>
        <div class='delivery_address'>
            <h2>Delivery coordinates</h2>
            <?php require_once 'presentation/includes/deliveryAddress.php'; ?>
        </div>
            <?php require_once 'presentation/includes/checkoutMessage.php'; ?>
    </div>
    <?php require_once 'presentation/includes/wednesdayDiscount.php'; ?>;
</body>

</html>
