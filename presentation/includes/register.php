<?php
// file     :   presentation/includes/register.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
?>

<form class='login_right' action='index.php?display=login' method=post>
    <label for='firstname'>firstname</label>
    <input type='text' name='firstname' placeholder='firstname' required/>
    <label for='surname'>surname</label>
    <input type='text' name='surname' placeholder='surname' required/>
    <label for='street'>street</label>
    <input type='text' id='street' name='street' placeholder='street' required/>
    <label for='housenumber'>number</label>
    <input type='text' id='housenumber' name='housenumber' placeholder='number' required/>
    <label for='locationID'>location</label>
    <select name='locationID' required>
        <option id='defaultoption' value='' selected>zipcode & city</option>
        <?php require 'presentation/includes/locationlist.php' ?>
    </select>
    <label for='phone'>phone</label>
    <input type='text' name='phone' placeholder='phone number' required/>      
