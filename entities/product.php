<?php
// file     :   entities/product.php
// author   :   sven.croon

class Product {    
    // properties
    private $ID, $name, $unitprice;
    // constructor
    public function __construct($product = null) {
        echo isset($product);
        if (isset($product)) {
            $this -> ID = $product['ID']
                  -> name = $product['name']
                  -> unitprice = $product['unitprice'];
        }
    }
    // getters
    public function getID() {
        return $this -> ID;
    }
    public function getName() {
        return $this -> name;
    }
    public function getUnitprice() {
        return $this -> unitprice;
    }
    public function findProductData($key, $keyValue, $data) {
        if ($$key == $keyValue) {
            return $$data;
        } else {
            return FALSE;
        }
    }
    // setters
    public function setID($ID) {
        $this -> ID = $ID;
        return $this;
    }
    public function setName($name) {
        $this -> name = $name;
        return $this;
    }
    public function setUnitprice($unitprice) {
        $this -> unitprice = $unitprice;
        return $this;
    }
}
