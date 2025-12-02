<?php

require_once __DIR__ . '/../job-11/Product.php';

class Clothing extends Product
{
    private string $size;
    private string $color;
    private string $type;
    private int $material_fee;
    protected PDO $pdo;

    public function __construct(
        int $id,
        string $name,
        array $photos,
        float $price,
        string $description,
        int $quantity,
        DateTime $createdAt,
        DateTime $updatedAt,
        int $category_id,
        string $size,
        string $color,
        string $type,
        int $material_fee,
        PDO $pdo
    ) {
        parent::__construct(
            $id,
            $name,
            $photos,
            $price,
            $description,
            $quantity,
            $createdAt,
            $updatedAt,
            $category_id,
            $pdo
        );

        $this->size = $size;
        $this->color = $color;
        $this->type = $type;
        $this->material_fee = $material_fee;
        $this->pdo = $pdo;
    }

    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM product WHERE id = :id");
        $query->execute(['id' => $id]);
        $product = $query->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            return false;
        }

        $query2 = $this->pdo->prepare("SELECT * FROM clothing WHERE product_id = :id");
        $query2->execute(['id' => $id]);
        $clothing = $query2->fetch(PDO::FETCH_ASSOC);

        if (!$clothing) {
            return false;
        }

        return new Clothing(
            $product['id'],
            $product['name'],
            json_decode($product['photos'], true),
            $product['price'],
            $product['description'],
            $product['quantity'],
            new DateTime($product['createdAt']),
            new DateTime($product['updatedAt']),
            $product['category_id'],
            $clothing['size'],
            $clothing['color'],
            $clothing['type'],
            $clothing['material_fee'],
            $this->pdo
        );
    }

    public function findAll(): array
    {
        $query = $this->pdo->query("
        SELECT p.*, c.size, c.color, c.type, c.material_fee
        FROM product p
        JOIN clothing c ON p.id = c.product_id
    ");

        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

        $results = [];

        foreach ($rows as $data) {
            $results[] = new Clothing(
                $data['id'],
                $data['name'],
                json_decode($data['photos'], true),
                $data['price'],
                $data['description'],
                $data['quantity'],
                new DateTime($data['createdAt']),
                new DateTime($data['updatedAt']),
                $data['category_id'],
                $data['size'],
                $data['color'],
                $data['type'],
                $data['material_fee'],
                $this->pdo
            );
        }

        return $results;
    }
}
