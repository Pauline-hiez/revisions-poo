<?php

require_once "Product.php";


$pdo = new PDO("mysql:host=localhost;dbname=draft-shop;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$product = new Product(
    1,
    "Converse",
    ["converse.jpg"],
    60,
    "Chaussures",
    10,
    new DateTime("2023-01-01"),
    new DateTime("2023-01-02"),
    1, // category_id
    $pdo // objet PDO
);



$product = new Product(
    2,
    "Converses",
    ["converses.jpg"],
    60,
    "Chaussures",
    39,
    new DateTime(),
    new DateTime(),
    1,
    $pdo
);

if (method_exists($product, 'create')) {
    $new = $product->create();
    var_dump($new);
} else {
    var_dump($product);
}
