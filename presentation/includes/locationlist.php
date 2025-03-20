<?php
//  file    :   presentation/includes/locationlist.php
//  author  :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $cities =    list of all cities from cities table where deliveries are possible
//              this is used in the logion/registration form location select drop-down list

$cities = CitiesDAO::getAllCities();
$i = 0;
while ($cities[$i]) {
    echo '<option value=' . $cities[$i]['ID'] . '>' . $cities[$i]['zipcode'] . ' ' . $cities[$i]['name'] . '</option>';
    $i++;
}     
?>

