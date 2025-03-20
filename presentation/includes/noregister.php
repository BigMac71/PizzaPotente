<?php
// file     :   presentation/includes/noregister.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
?>

<form class='login_right' action='index.php?display=login' method=post>
    <label for='firstname' class='obscure'>firstname</label>
    <input class='obscure' type='text' name='firstname' disabled/>
    <label for='surname' class='obscure'>surname</label>
    <input class='obscure' type='text' name='surname' disabled/>
    <label for='street' class='obscure'>street</label>
    <input class='obscure' type='text' id='street' name='street' disabled/>
    <label for='housenumber' class='obscure'>number</label>
    <input class='obscure' type='text' id='housenumber' name='housenumber' disabled/>
    <label for='locationID' class='obscure'>location</label>
    <select class='obscure' name='locationID' disabled>
        <option value='' disabled selected>zipcode city</option>
        <?php require 'presentation/includes/locationlist.php' ?>
    </select>
    <label for='phone' class='obscure'>phone</label>
    <input class='obscure' type='text' name='phone' disabled/>
