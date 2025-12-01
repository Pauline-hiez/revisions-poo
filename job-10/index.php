<?php

require_once "Product.php";


$pdo = new PDO("mysql:host=localhost;dbname=draft-shop;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$product = new Product(
    2,
    "Nokia 3310",
    ["nokia.jpg"],
    35,
    "Téléphone",
    5,
    new DateTime("2023-01-01"),
    new DateTime("2023-01-02"),
    2,
    $pdo
);

$product->setPrice(14.99);
$product->setName("Nokia 3310");

$result = $product->update();

var_dump($result);
