<?php
// file     :   entities/city.php
// author   :   sven.croon

class City {    
    // properties
    private $ID, $zipcode, $name, $delivery; 
    // constructor
    public function __construct($ID = null, $zipcode = null, $name = null, $delivery = null) {
        $this -> setID($ID)
              -> setZipcode($zipcode)
              -> setName($name)
              -> setDelivery($delivery);
    }    
    // getters
    public function getID() {
        return $this -> ID;
    }
    public function getZipcode() {
        return $this -> zipcode;
    }
    public function getName() {
        return $this -> name;
    }
    public function getDelivery() {
        return $this -> delivery;
    }   
    // setters
    public function setID($ID) {
        $this -> ID = $ID;
        return $this;
    }
    public function setZipcode($zipcode) {
        $this -> zipcode = $zipcode;
        return $this;
    }
    public function setName($name) {
        $this -> name = $name;
        return $this;
    }
    public function setDelivery($delivery) {
        $this -> delivery = $delivery;
        return $this;
    }   
}
