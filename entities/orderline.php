<?php
// file     :   entities/orderline.php
// author   :   sven.croon

class Orderline {
    // propoerties
    private $ID, $orderID, $productID, $unitprice, $number;
    // constructor
    public function __construct($orderline = null) {
        $this -> setID($orderline['ID'])
              -> setOrderID($orderline['orderID'])
              -> setProductID($orderline['productID'])
              -> setUnitprice($orderline['unitprice'])
              -> setNumber($orderline['number']);
    }
    // getters
    public function getID() {
        return $this -> ID;
    }
    public function getOrderID() {
        return $this -> orderID;
    }
    public function getProductID() {
        return $this -> productID;
    }
    public function getUnitprice() {
        return $this -> unitprice;
    }
    public function getNumber() {
        return $this -> number;
    }
    // settters
    public function setID($ID) {
        $this -> ID = $ID;
        return $this;
    }
    public function setOrderID($orderID) {
        $this -> orderID = $orderID;
        return $this;
    }
    public function setProductID($productID) {
        $this -> productID = $productID;
        return $this;
    }
    public function setUnitprice($unitprice) {
        $this -> unitprice = $unitprice;
        return $this;
    }
    public function setNumber($number) {
        $this -> number = $number;
        return $this;
    }
}
