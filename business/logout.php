<?php
// file     :   business/logout.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------

$_SESSION['login_status'] = FALSE;
unset($_SESSION['login_msg']);
unset($_GET['logout']);