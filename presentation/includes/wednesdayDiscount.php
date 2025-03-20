<?php
//  file    :   presentation/includes/wednesdayDiscount.php
//  author  :   sven.croon

// variables:
// -----------------------------------------------------------------------------

// show 'wednesday = pizzaday' discount banner only on wednesdays
if (date('N', time()) == 3) {
    echo '<div class="discountBanner">';
    echo 'Wednesday = Pizzaday!</br>';
    echo 'All pizzas at 25% discount!';
    echo '</div>';
}

