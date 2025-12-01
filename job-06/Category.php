<?php

class Category
{
    private int $id;
    private string $name;
    private string $description;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private PDO $pdo;

    public function __construct(
        int $id,
        string $name,
        string $description,
        DateTime $createdAt,
        DateTime $updatedAt,
        PDO $pdo
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->pdo = $pdo;
    }

    //GETTERS
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    //Fonction getProduct
    public function getProducts(): array
    {
        $query = $this->pdo->prepare("SELECT * FROM product WHERE category_id = :id");
        $query->execute(['id' => $this->id]);

        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

        $products = [];

        foreach ($rows as $productData) {
            $products[] = new Product(
                $productData['id'],
                $productData['name'],
                json_decode($productData['photos'], true),
                $productData['price'],
                $productData['description'],
                $productData['quantity'],
                new DateTime($productData['createdAt']),
                new DateTime($productData['updatedAt']),
                $productData['category_id']
            );
        }

        return $products;
    }

    //SETTERS
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
