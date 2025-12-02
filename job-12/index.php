<?php


require_once __DIR__ . '/Clothing.php';
require_once __DIR__ . '/Electronic.php';

$pdo = new PDO("mysql:host=localhost;dbname=draft-shop;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$clothing = new Clothing(
    1,
    'Nom du vêtement',
    ['photo.jpg'],
    50.0,
    'Description',
    5,
    new DateTime('2023-01-01'),
    new DateTime('2023-01-02'),
    1,
    'M',
    'Bleu',
    'T-shirt',
    10,
    $pdo
);

$pdo = new PDO("mysql:host=localhost;dbname=draft-shop;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$product = new Product(
    1,
    "Nom du produit",
    ["converses.jpg"],
    100,
    "Description",
    10,
    new DateTime("2023-01-01"),
    new DateTime("2023-01-02"),
    1,
    $pdo
);

var_dump($clothing->findOneById(1));
var_dump($clothing->findAll());


require_once __DIR__ . '/Clothing.php';

$pdo = new PDO("mysql:host=localhost;dbname=draft-shop;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$electronic = new Electronic(
    1,
    'Nokia 3310',
    ['nokia.jpg'],
    15,
    'Téléphone',
    5,
    new DateTime('2023-01-01'),
    new DateTime('2023-01-02'),
    1,
    'Nokia',
    10,
    $pdo
);

$pdo = new PDO("mysql:host=localhost;dbname=draft-shop;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$product = new Product(
    1,
    "Nokia 3310",
    ["nokia.jpg"],
    15,
    "Téléphone",
    10,
    new DateTime("2023-01-01"),
    new DateTime("2023-01-02"),
    1,
    $pdo
);

var_dump($electronic->findOneById(1));
var_dump($electronic->findAll());
