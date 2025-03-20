<?php
// file     :   data/customerDAO.php
// author   :   sven.croon

abstract class CustomerDAO {
    // properties
    private static $orderInfo =
        'SELECT orders.discount, orders.timeplaced, orders.timedelivered, orders.delivered, '
        . 'orderlines.number, products.name, products.unitprice '
        . 'FROM orders JOIN orderlines ON orders.ID = orderlines.orderID '
        . 'JOIN products ON products.ID = orderlines.productID ';
    // methods
    public static function checkLogin($email, $pwd) {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = 'SELECT ID, email, password FROM customers WHERE email = :email';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':email', $email);
        $bool = $stmt->execute();
        if (!$bool) {
            $stmt = null;
            PizzeriaDatabase::disconnectDB($dbh);            
            throw new Exception('SQL: Login check failed!');
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);
        if ($result['email'] == $email) {
            if ($result['password'] == $pwd) {
                setcookie('PizzaPotente', $email);
                setcookie('PizzaPotenteID', $result['ID']);
                return array(TRUE, 'Great Success!');
            } else {
                return array(FALSE, 'password incorrect');
            }
        } else {
            return array(FALSE, 'username not found');
        }
    }
    public static function accountExists($email) {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = 'SELECT email, password FROM customers WHERE email = :email';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':email', $email);
        $bool = $stmt->execute();
        if (!$bool) {
            $stmt = null;
            PizzeriaDatabase::disconnectDB($dbh);            
            throw new Exception('SQL: Account Exists check failed!');
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);    
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);    
        if ($result['email'] == $email) {
            return TRUE;
        } else {
            return FALSE;
        }    
    }
    public static function registerCustomer($customer) {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = 'INSERT INTO customers (firstname, surname, street, housenumber, locationID, phone, email, password, discountEligible)'
                . 'VALUES (:firstname,:surname,:street,:housenumber,:locationID,:phone,:email,:password,:discountEligible)';
        $stmt = $dbh->prepare($sql);
        $firstName = $customer->getFirstname();
        $stmt->bindParam(':firstname', $firstName);
        $surname = $customer->getSurname();
        $stmt->bindParam(':surname', $surname);
        $street = $customer->getStreet();
        $stmt->bindParam(':street', $street);
        $houseNumber = $customer->getHousenumber();
        $stmt->bindParam(':housenumber', $houseNumber);
        $locationID = $customer->getLocationID();
        $stmt->bindParam(':locationID', $locationID);
        $phoneNumber = $customer->getPhone();
        $stmt->bindParam(':phone', $phoneNumber);        
        $email = $customer->getEmail();
        $stmt->bindParam(':email', $email);
        $pwd = $customer->getPassword();
        $stmt->bindParam(':password', $pwd);
        $discntEligible = $customer->getDiscountEligible();
        $stmt->bindParam(':discountEligible', $discntEligible);
        $bool = $stmt->execute();
        $stmt = null;
        if (!$bool) {
            PizzeriaDatabase::disconnectDB($dbh);    
            throw new Exception('SQL: Customer Registration Failed!');
        }
        $customerID = $dbh -> lastInsertId();
        PizzeriaDatabase::disconnectDB($dbh);          
        setcookie('PizzaPotente', $customer->getEmail());
        setcookie('PizzaPotenteID', $customerID);        
        return TRUE;
    }
    public static function registerTempCustomer($customer) {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = 'INSERT INTO customers (firstname, surname, street, housenumber, locationID, phone, discountEligible) '
                . 'VALUES (:firstname, :surname, :street, :housenumber, :locationID, :phone, :discountEligible)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':firstname', $customer -> getFirstname());
        $stmt->bindParam(':surname', $customer -> getSurname());
        $stmt->bindParam(':street', $customer -> getStreet());
        $stmt->bindParam(':housenumber', $customer -> getHousenumber());
        $stmt->bindParam(':locationID', $customer -> getLocationID());            
        $stmt->bindParam(':phone', $customer -> getPhone());
        $stmt->bindParam(':discountEligible', $customer -> getDiscountEligible());
        $bool = $stmt->execute();
        $stmt = null; 
        if (!$bool) {
            PizzeriaDatabase::disconnectDB($dbh);
            throw new Exception('SQL: Temporary Customer Registration Failed!');
        }
        $customerID = $dbh -> lastInsertId();
        PizzeriaDatabase::disconnectDB($dbh);
        $customerName = $customer -> getFirstname() . ' ' . $customer -> getSurname();
        setcookie('PizzaPotente', $customerName);
        setcookie('PizzaPotenteID', $customerID);        
        return TRUE;
    }
    public static function getOrderHistory($customerID) {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = self::$orderInfo
               . 'WHERE (orders.customerID = :customerID)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':customerID', $customerID);
        $bool = $stmt->execute();
        if (!$bool) {
            $stmt = null;
            PizzeriaDatabase::disconnectDB($dbh);    
            throw new Exception('SQL: Get Order History Failed!');
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);
        return $result;
    }
    public static function getOutstandingOrders($customerID) {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = self::$orderInfo
               . 'WHERE (orders.customerID = :customerID)'
               . 'AND (orders.delivered = 0)';
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
    public static function getCustomerData($customerID) {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = 'SELECT * FROM customers WHERE ID = :ID';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':ID', $customerID);
        $bool = $stmt->execute();
        if (!$bool) {
            $stmt = null;
            PizzeriaDatabase::disconnectDB($dbh);    
            throw new Exception('SQL: get Customer Data Failed!');
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);
        return $result;                
    }
    public static function findCustomerID($email) {
        $dbh = PizzeriaDatabase::connectDB();
        $sql = 'SELECT ID FROM customers WHERE email = :email';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':email', $email);
        $bool = $stmt->execute();
        if (!$bool) {
            $stmt = null;
            PizzeriaDatabase::disconnectDB($dbh);    
            throw new Exception('SQL: Find Customer ID Failed!');
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
        PizzeriaDatabase::disconnectDB($dbh);
        return $result['ID'];                
    }
}
