<?php
// file     :   data/orderDAO.php
// author   :   sven.croon
    
class OrderDAO {
    // properties
    private static $orderInfo =
        'SELECT orders.discount, orders.timeplaced, orderlines.number, products.name, products.unitprice '
        . 'FROM orders JOIN orderlines ON orders.ID = orderlines.orderID '
        . 'JOIN products ON products.ID = orderlines.productID ';
    // methods
    public function getOrder($orderID) {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = self::$orderInfo
               . 'WHERE ID = :ID';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':ID', $orderID);
        $bool = $stmt->execute();
        if (!$bool) {
            $stmt = null;
            PizzeriaDatabase::disconnectDB($dbh);
            throw new Exception('SQL: Get Order failed!');
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);
        return $result;
    }
    public function getOrdersFromPeriod($beginDate, $endDate) {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = self::$orderInfo
               . 'WHERE (timeplaced >= :beginDate) AND (timeplaced <= :endDate)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':beginDate', $beginDate);
        $stmt->bindParam(':endDate', $endDate);
        $bool = $stmt->execute();
        if (!$bool) {
            $stmt = null;
            PizzeriaDatabase::disconnectDB($dbh);
            throw new Exception('SQL: Get Orders From Period failed!');
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);
        return $result;
    }
    public function getOrdersOnDiscount($discnt) {
        $dbh = PizzeriaDatabase::connectDB();
        $discnt = intval($discnt);
        $sql = self::$orderInfo
               . 'WHERE discount = :discnt';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':discnt', $discnt);
        $bool = $stmt->execute();
        if (!$bool) {
            $stmt = null;
            PizzeriaDatabase::disconnectDB($dbh);
            throw new Exception('SQL: Get Orders On Discount failed!');
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);
        return $result;
    }
    public function getOrdersOnDeliveryTime($timeInterval) {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = self::$orderInfo
               . 'WHERE (timedelivered - timeplaced <=  :timeInterval)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':timeInterval', $timeInterval);
        $bool = $stmt->execute();
        if (!$bool) {
            $stmt = null;
            PizzeriaDatabase::disconnectDB($dbh);
            throw new Exception('SQL: Get Orders On Delivery Time failed!');
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);
        return $result;
    }
    public function getOutstandingOrders() {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = self::$orderInfo
               . 'WHERE orders.delivered = 0';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':customerID', $customerID);
        $bool = $stmt->execute();
        if (!$bool) {
            $stmt = null;
            PizzeriaDatabase::disconnectDB($dbh);    
            throw new Exception('SQL: Get Outstanding Orders Failed!');
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);
        return $result;
    }
    public static function placeOrderline($orderline, &$dbh) {
        $sql = 'INSERT INTO orderlines (orderID, productID, unitprice, number)'
               . ' VALUES (:orderID, :productID, :unitprice, :number)';
        $stmt = $dbh -> prepare($sql);
        $orderID = $orderline -> getOrderID();
        $stmt->bindParam(':orderID', $orderID);      
        $productID = $orderline -> getProductID();
        $stmt->bindParam(':productID', $productID);
        // unitprice needs to be written for every order because it can change over time
        // we need to log the historical price, at the time of the order
        $unitPrice = $orderline -> getUnitprice();
        $stmt->bindParam(':unitprice', $unitPrice);
        $number = $orderline -> getNumber();
        $stmt->bindParam(':number', $number);     
        $bool = $stmt->execute();        
    }
    public static function placeOrder($order, $orderlines) {
        // write order to DB, in order to get the autoincrement OrderID, which is a foreign key in orderlines
        // use PDO::beginTransaction and ::commit instead of autocommit
        // in order to be able to rollback both order and orderlines INSERT in case of issues
        $dbh = PizzeriaDatabase::connectDB();
        $dbh -> beginTransaction();
        $sql = 'INSERT INTO orders(ID, customerID, discount, totalprice, timeplaced, timedelivered, delivered, remarks)'
                . ' VALUES (:ID, :customerID, :discount, :totalprice, FROM_UNIXTIME(:timeplaced), FROM_UNIXTIME(:timedelivered), :delivered , :remarks)';
        $stmt = $dbh->prepare($sql);
        $orderID = $order -> getID();
        $stmt->bindParam(':ID', $orderID);      
        $customerID = $order -> getCustomerID();
        $stmt->bindParam(':customerID', $customerID);
        $discount = $order -> getDiscount();
        $stmt->bindParam(':discount', $discount);
        $totalPrice = $order -> getTotalprice();
        $stmt->bindParam(':totalprice', $totalPrice);
        $timePlaced = $order -> getTimeplaced();
        $stmt->bindParam(':timeplaced', $timePlaced);
        $timeDelivered = $order -> getTimedelivered();
        $stmt->bindParam(':timedelivered', $timeDelivered);
        $delivered = $order -> getDelivered();
        $stmt->bindParam(':delivered', $delivered);
        $remarks = $order -> getRemarks();
        $stmt->bindParam(':remarks', $remarks);    
        $bool = $stmt->execute();
        $orderID = $dbh -> lastInsertId(); // here we get the OrderID value, needed for inserting the orderlines into our DB
        // now we can call the function that places each orderline in the DB
        foreach($orderlines as $orderline) {
            $orderline -> setOrderID($orderID);
            self::placeOrderline($orderline, $dbh);
        }
        // order and ALL orderlines have been sent to DB, time to commit this transaction
        $dbh -> commit();
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);    
        if (!$bool) {
            throw new Exception('SQL: Place Order Failed!');
        };
        $_SESSION['msg'] = 'Thanks for ordering at Pizza Potente!<br>Your order will be delivered ASAP.<br>Have a nice day.';
        return TRUE;
    }
}
