<?php
// file     :   presentation/home.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $_GET['logout'] =    set to TRUE when the logout button is clicked

if (isset($_GET['logout']) AND $_GET['logout']) {
    require_once 'business/logout.php';
}
?>

<!DOCTYPE html>
<html class='home'>

<head>
    <meta charset='UTF-8'>
    <title>Pizza Potente - home</title>
    <link rel='stylesheet' type='text/css' href='css/normalize.css'/>  
    <link rel='stylesheet' type='text/css' href='css/pizzapotente.css'/>
</head>

<body>
    <?php require_once 'presentation/includes/pageheader.php'; ?>
</body>

</html>
