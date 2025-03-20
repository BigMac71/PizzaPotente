<?php
// file     :   entities/customer.php
// author   :   sven.croon

class Customer {   
    // properties
    private $ID, $firstname, $surname, $street, $housenumber, $locationID, $phone, $email, $password, $discountEligible;   
    //constructor
    public function __construct($coordinates) {
        $this -> setFirstname(isset($coordinates['firstname'])? $coordinates['firstname'] : null)
              -> setSurname(isset($coordinates['surname'])? $coordinates['surname'] : null)
              -> setStreet(isset($coordinates['street'])? $coordinates['street'] : null)
              -> setHousenumber(isset($coordinates['housenumber'])? $coordinates['housenumber'] : null)
              -> setLocationID(isset($coordinates['locationID'])? $coordinates['locationID'] : null)
              -> setPhone(isset($coordinates['phone'])? $coordinates['phone'] : null)
              -> setEmail(isset($coordinates['email'])? $coordinates['email'] : null)
              -> setPassword(isset($coordinates['password'])? $coordinates['password'] : null)
              -> setDiscountEligible(isset($coordinates['discountEligible'])? $coordinates['discountEligible'] : null);
    }   
    // getters
    public function getID() {
        return $this -> ID;
    }  
    public function getFirstname() {
        return $this -> firstname;
    }
    public function getSurname() {
        return $this -> surname;
    }
    public function getStreet() {
        return $this -> street;
    }
    public function getHousenumber() {
        return $this -> housenumber;
    }   
    public function getLocationID() {
        return $this->locationID;
    }
    public function getPhone() {
        return $this -> phone;
    }
    public function getEmail() {
        return $this -> email;
    }
    public function getPassword() {
        return $this -> password;
    }
    public function getDiscountEligible() {
        return $this -> discountEligible;
    }
    // setters
    public function setID($ID) {
        $this -> ID = $ID;
        return $this;
    }
    public function setFirstname($firstname) {
        $this -> firstname = $firstname;
        return $this;
    }
    public function setSurname($surname) {
        $this -> surname = $surname;
        return $this;
    }
    public function setStreet($street) {
        $this -> street = $street;
        return $this;
    }
    public function setHousenumber($housenumber) {
        $this -> housenumber = $housenumber;
        return $this;
    }
    public function setLocationID($locationID) {
        $this->locationID = $locationID;
        return $this;
    }
    public function setPhone($phone) {
        $this -> phone = $phone;
        return $this;
    }
    public function setEmail($email) {
        $this -> email = $email;
        return $this;
    }
    public function setPassword($password) {
        $this -> password = $password;
        return $this;
    }
    public function setDiscountEligible($discountEligible) {
        $this -> discountEligible = $discountEligible;
        return $this;
    }
}
