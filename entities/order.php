<?php
// file     :   entities/order.php
// author   :   sven.croon

class Order {   
    // properties
    private $ID, $customerID, $discount, $totalprice, $timeplaced, $timedelivered, $delivered, $remarks;    
    //constructor
    public function __construct($details) {
        $this -> setID($details['ID'])
              -> setCustomerID($details['customerID'])
              -> setDiscount($details['discount'])
              -> setTotalprice($details['totalprice'])
              -> setTimeplaced($details['timeplaced'])
              -> setTimedelivered($details['timedelivered'])
              -> setDelivered($details['delivered'])
              -> setRemarks($details['remarks']);
    }    
    // getters
    public function getID() {
        return $this -> ID;
    }
    public function getCustomerID() {
        return $this -> customerID;
    }
    public function getDiscount() {
        return $this -> discount;
    }
    public function getTotalprice() {
        return $this->totalprice;
    }    
    public function getTimeplaced() {
        return $this -> timeplaced;
    }
    public function getTimedelivered() {
        return $this -> timedelivered;
    }
    public function getDelivered() {
        return $this -> delivered;
    }
    public function getRemarks() {
        return $this->remarks;
    }
    // setters
    public function setID($ID) {
        $this -> ID = $ID;
        return $this;
    }
    public function setCustomerID($customerID) {
        $this -> customerID = $customerID;
        return $this;
    }
    public function setDiscount($discount) {
        $this -> discount = $discount;
        return $this;
    }    
    public function setTotalprice($totalprice) {
        $this->totalprice = $totalprice;
        return $this;
    }
    public function setTimeplaced($timeplaced) {
        $this -> timeplaced = $timeplaced;
        return $this;
    }
    public function setTimedelivered($timedelivered) {
        $this -> timedelivered = $timedelivered;
        return $this;
    }
    public function setDelivered($delivered) {
        $this -> delivered = $delivered;
        return $this;
    }
    public function setRemarks($remarks) {
        $this->remarks = $remarks;
        return $this;
    }
}
