<?php

require_once "Product.php";

$pdo = new PDO("mysql:host=localhost;dbname=draft-shop;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$product = new Product(0, "", [], 0, "", 0, new DateTime(), new DateTime(), 0, $pdo);

$allProducts = $product->findAll();

var_dump($allProducts);
