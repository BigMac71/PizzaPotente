<?php
//  file    :   presentation/includes/showpizzas.php
//  author  :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $products =  list of objects: all pizzas retrieved from products database

$products = ProductDAO::getProducts();
foreach($products as $product) {
?>

<div class='pizzabox'>
    <img class='pizza' src='images/<?php echo $product -> getName(); ?>.png'/>
    <div class='pizzaorderbox'>
        <div class='showdata'>
            <p class='pizzaname'>
                <?php echo $product -> getName(); ?>
            </p>
            <p class='pizzaprice'>
                <?php echo $product -> getUnitprice() . ' €'; ?>
            </p>
        </div>
        <form class='orderpizza' action='index.php?display=browse&orderpizza=true' method='post'>
            <input type='number' name='numberofpizzas' min='0' max='20' value='0'/>
            <input type='text' name='unitprice' value='<?php echo $product -> getUnitprice(); ?>' hidden/>
            <input type='text' name='pizzaname' value='<?php echo $product -> getName(); ?>' hidden/>
            <input type='text' name='pizzaID' value='<?php echo $product -> getID(); ?>' hidden/>  
            <input type='submit' value='order'/>
        </form>
    </div>
</div>

<?php
}
?>
