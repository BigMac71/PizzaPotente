<?php
// file     :   presentation/about.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
?>

<!DOCTYPE html>
<html class='sepia'>

<head>
    <meta charset='UTF-8'>
    <title>Pizza Potente - about</title>
    <link rel='stylesheet' type='text/css' href='css/normalize.css'/>    
    <link rel='stylesheet' type='text/css' href='css/pizzapotente.css'/>
</head>

<body>
    <?php
        require_once 'presentation/includes/pageheader.php';
        require_once 'presentation/includes/loginstatus.php';
    ?>
    <div class ='about'>
        <p>In 1897 an Italian immigrant reinvented a Napoletana staple food into one of the worlds most eaten foods.</p>
        <p>Diest was the birth place of Belgian style pizza.
        <p>During the year of 1905, Pizza Potente was licensed by the City of Diest, becoming Belgium's First Pizzeria.</p>
        <p>Over 100 years and still coveted as one of the Best Pizzeria's in the country.</p>
        <p>Highly regarded and rated as the Best of Flanders, a Region of Pizzeria's.</p>
        <p>We started it all and are still on top after more than 100 years!</p>
        <div><img class='signature' src='images/signature.png' alt='johnhancock'/></div>
    </div>
    <div id='map'>&nbsp;</div>
        <script>
            function initMap() {
            var mapDiv = document.getElementById('map');
            var map = new google.maps.Map(mapDiv, {
                center: {lat: 50.98582, lng: 5.05283},
                zoom: 13});
            }
            </script>
            <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyB8v8STTb3tnHZA8kOt9OtxGhZi-Y-rJmg&callback=initMap' async defer></script>
  </body>

</html>
