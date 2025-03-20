<?php
// file     :   data/citiesDAO.php
// author   :   sven.croon
    
abstract class CitiesDAO {       
    // methods
    public static function getAllCities() {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = 'SELECT ID, zipcode, name FROM cities WHERE delivery = 1';
        $stmt = $dbh->prepare($sql);
        $bool = $stmt->execute();
        if (!$bool) {
            $stmt = null;
            PizzeriaDatabase::disconnectDB($dbh);
            throw new Exception('SQL: Cities Data retrieval failed!');
        }        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);
        return $result;
    }
    public static function getLocationInfo($locationID) {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = 'SELECT zipcode, name FROM cities WHERE ID = :ID';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':ID', $locationID);        
        $bool = $stmt->execute();
        if (!$bool) {
            $stmt = null;
            PizzeriaDatabase::disconnectDB($dbh);
            throw new Exception('SQL: Get Location Info failed!');
        }        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);
        return $result; 
    }
}
