<?php


require_once "Product.php";

$product = new Product(
    1,
    "Nom du produit",
    ["converses.jpg"],
    100,
    "Description",
    10,
    new DateTime("2023-01-01"),
    new DateTime("2023-01-02")
);

var_dump($product->getName());
var_dump($product->getPrice());

$product->setPrice(150);
var_dump($product->getPrice());
