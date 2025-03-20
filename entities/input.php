<?php
// file     :   entities/input.php
// author   :   sven.croon

abstract class Input {
    // methods
    public static function sanitizeRegisterPOST() {
        if (isset($_POST['firstname'])) {
            $_SESSION['firstname'] = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['surname'])) {
            $_SESSION['surname'] = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['street'])) {
            $_SESSION['street'] = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['housenumber'])) {
            $_SESSION['housenumber'] = filter_input(INPUT_POST, 'housenumber', FILTER_VALIDATE_INT);
        }
        if (isset($_POST['locationID'])) {
            $_SESSION['locationID'] = filter_input(INPUT_POST, 'locationID', FILTER_VALIDATE_INT);
        }
        if (isset($_POST['phone'])) {
            $_SESSION['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        }
    }
    public static function sanitizeLoginPOST() {
        if (isset($_POST['email'])) {
            $_SESSION['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        }
        if (isset($_POST['password'])) {
            $_SESSION['password'] = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        }        
    }
    public static function sanitizeOrderPOST() {
        if (isset($_POST['pizzaID'])) {
            $_SESSION['pizzaID'] = filter_input(INPUT_POST, 'pizzaID', FILTER_VALIDATE_INT);
        }
        if (isset($_POST['pizzaname'])) {
            $_SESSION['pizzaname'] = filter_input(INPUT_POST, 'pizzaname', FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['unitprice'])) {
            $_SESSION['unitprice'] = filter_input(INPUT_POST, 'unitprice', FILTER_VALIDATE_INT);
        }
        if (isset($_POST['numberofpizzas'])) {
            $_SESSION['numberofpizzas'] = filter_input(INPUT_POST, 'numberofpizzas', FILTER_VALIDATE_INT, ['options' => ['min_range'=>0, 'max_range'=>20]]);
        }       
    }
}
