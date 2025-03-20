<?php
// file     :   data/pizzeriaDatabase.php
// author   :   sven.croon

abstract class PizzeriaDatabase {
    private static $dsn = 'mysql:host=localhost;dbname=pizzeria;charset=utf8';
    private static $usr = 'pizzaAdmin';
    private static $pwd = 'p1zza@dm1n';
    // (dis)connectors
    public static function connectDB() {
        try {
            return new PDO(self::$dsn, self::$usr, self::$pwd);
        }
        catch (PDOException $e) {
            print 'Error!: ' . $e->getMessage() . '<br/>';
            die();
        }
    }
    public static function disconnectDB(&$dbh) {
        $dbh = null;
        unset($dbh);
    }
}
