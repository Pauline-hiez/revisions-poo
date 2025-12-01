
<?php
require_once __DIR__ . '/../job-02/Category.php';

class Product
{
    public int $category_id;

    public function getCategory(PDO $pdo)
    {
        $query = $pdo->prepare("SELECT * FROM category WHERE id = :id");
        $query->execute(['id' => $this->category_id]);
        $data = $query->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        return new Category(
            $data['id'],
            $data['name'],
            $data['description'],
            new DateTime($data['createdAt']),
            new DateTime($data['updatedAt'])
        );
    }
}


$pdo = new PDO(
    "mysql:host=localhost;dbname=draft-shop;charset=utf8",
    "root",
    ""
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$product = new Product();
$product->category_id = 2;
$category = $product->getCategory($pdo);
var_dump($category);
