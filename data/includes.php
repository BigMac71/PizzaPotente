<?php
// file     :   data/includes.php
// author   :   sven.croon

// entity definitions
require_once 'entities/city.php';
require_once 'entities/customer.php';
require_once 'entities/order.php';
require_once 'entities/orderline.php';
require_once 'entities/product.php';
require_once 'entities/input.php';

// DAO class definitions
require_once 'data/pizzeriaDatabase.php'; //DB connection
require_once 'data/citiesDAO.php';
require_once 'data/customerDAO.php';
require_once 'data/orderDAO.php';
require_once 'data/productDAO.php';
