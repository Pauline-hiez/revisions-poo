<?php

require_once "Product.php";

class Electronic extends Product
{
    private string $brand;
    private int $waranty_fee;
    protected PDO $pdo;

    public function __construct(
        $id,
        $name,
        $photos,
        $price,
        $description,
        $quantity,
        $createdAt,
        $updatedAt,
        $category_id,
        $brand,
        $waranty_fee,
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

        $this->brand = $brand;
        $this->waranty_fee = $waranty_fee;
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
        $electronic = $query2->fetch(PDO::FETCH_ASSOC);

        if (!$electronic) {
            return false;
        }

        return new Electronic(
            $product['id'],
            $product['name'],
            json_decode($product['photos'], true),
            $product['price'],
            $product['description'],
            $product['quantity'],
            new DateTime($product['createdAt']),
            new DateTime($product['updatedAt']),
            $product['category_id'],
            $electronic['brand'],
            $electronic['wranty_fee'],
            $this->pdo
        );
    }

    public function findAll(): array
    {
        $query = $this->pdo->query("
        SELECT p.*, e.brand, e.waranty_fee
        FROM product p
        JOIN electronic e ON p.id = e.product_id
    ");

        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

        $results = [];

        foreach ($rows as $data) {
            $results[] = new Electronic(
                $data['id'],
                $data['name'],
                json_decode($data['photos'], true),
                $data['price'],
                $data['description'],
                $data['quantity'],
                new DateTime($data['createdAt']),
                new DateTime($data['updatedAt']),
                $data['category_id'],
                $data['brand'],
                $data['waranty_fee'],
                $this->pdo
            );
        }

        return $results;
    }
}
