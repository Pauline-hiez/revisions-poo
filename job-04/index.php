
<?php
require_once __DIR__ . '/../job-01/Product.php';

try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=draft-shop;charset=utf8",
        "root",
        ""
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$query = $pdo->prepare("SELECT * FROM product WHERE id = :id");
$query->execute(['id' => 2]);

$productData = $query->fetch(PDO::FETCH_ASSOC);

if (!$productData) {
    die("Aucun produit trouvé avec l'id 2");
}


$product = new Product(
    $productData['id'],
    $productData['name'],
    json_decode($productData['photos'], true), //Conversion en tableau
    $productData['price'],
    $productData['description'],
    $productData['quantity'],
    new DateTime($productData['createdAt']),
    new DateTime($productData['updatedAt']),
    $productData['category_id']
);

var_dump($product);
