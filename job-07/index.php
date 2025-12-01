<?php

require_once __DIR__ . '/Category.php';
require_once __DIR__ . '/../job-01/Product.php';

$pdo = new PDO("mysql:host=localhost;dbname=draft-shop;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$category = new Category(1, "Nom catégorie", "Description", new DateTime(), new DateTime(), $pdo);
$product = $category->findOneById(2);

if ($product === false) {
    echo "Aucun produit trouvé.";
} else {
    var_dump($product);
}
