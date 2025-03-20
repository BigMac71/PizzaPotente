<?php
// file     :   data/productDAO.php
// author   :   sven.croon

abstract class ProductDAO {
    public function getProducts($minPrice = 0, $maxPrice = 9999) {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = 'SELECT ID, name, unitprice FROM products WHERE (unitprice >= :minPrice AND unitprice <= :maxPrice)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':minPrice', $minPrice);
        $stmt->bindParam(':maxPrice', $maxPrice);        
        $bool = $stmt->execute();
        if (!$bool) {
            $stmt = null;
            PizzeriaDatabase::disconnectDB($dbh);
            throw new Exception('SQL: Get All Products failed!');
        }
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Product');
        $result = $stmt->fetchAll();
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);
        return $result;                
    }
}
