
<?php
require_once __DIR__ . '/../job-02/Category.php';

class Product
{

    public int $id;
    public string $name;
    public array $photos;
    public int $price;
    public string $description;
    public int $quantity;
    public DateTime $createdAt;
    public DateTime $updatedAt;
    public int $category_id;

    public function __construct(
        int $id,
        string $name,
        array $photos,
        int $price,
        string $description,
        int $quantity,
        DateTime $createdAt,
        DateTime $updatedAt,
        int $category_id
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->category_id = $category_id;
    }

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
            new DateTime($data['updatedAt']),
            $pdo
        );
    }
}


$pdo = new PDO(
    "mysql:host=localhost;dbname=draft-shop;charset=utf8",
    "root",
    ""
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$product = new Product(
    2,
    'Nom du produit',
    ['photo1.jpg'],
    100,
    'Description',
    10,
    new DateTime('2023-01-01'),
    new DateTime('2023-01-02'),
    2
);

$category = $product->getCategory($pdo);
var_dump($category);
