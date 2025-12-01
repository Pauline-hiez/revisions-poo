<?php

class Product
{
    private int $id;
    private string $name;
    /** 
     * @var array<string>
     */
    private array $photos;
    private int $price;
    private string $description;
    private int $quantity;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private int $category_id;
    private PDO $pdo;

    public function __construct(
        int $id,
        string $name,
        array $photos,
        int $price,
        string $description,
        int $quantity,
        DateTime $createdAt,
        DateTime $updatedAt,
        int $category_id,
        PDO $pdo
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
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $query = $this->pdo->query("SELECT * FROM product");
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

        $products = [];

        foreach ($rows as $data) {
            $products[] = new Product(
                $data['id'],
                $data['name'],
                json_decode($data['photos'], true),
                $data['price'],
                $data['description'],
                $data['quantity'],
                new DateTime($data['createdAt']),
                new DateTime($data['updatedAt']),
                $data['category_id'],
                $this->pdo
            );
        }
        return $products;
    }

    public function create()
    {
        try {
            $query = $this->pdo->prepare("
            INSERT INTO product (name, photos, price, description, quantity, createdAt, updatedAt, category_id)
            VALUES (:name, :photos, :price, :description, :quantity, :createdAt, :updatedAt, :category_id)
        ");

            $success = $query->execute([
                ":name"        => $this->name,
                ":photos"      => json_encode($this->photos),
                ":price"       => $this->price,
                ":description" => $this->description,
                ":quantity"    => $this->quantity,
                ":createdAt"   => $this->createdAt->format("Y-m-d H:i:s"),
                ":updatedAt"   => $this->updatedAt->format("Y-m-d H:i:s"),
                ":category_id" => $this->category_id
            ]);

            if (!$success) {
                return false;
            }

            $this->id = $this->pdo->lastInsertId();

            return $this;
        } catch (Exception $e) {
            return false;
        }
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

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
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

    public function setPhotos(array $photos): void
    {
        $this->photos = $photos;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function setCategoryId(int $category_id)
    {
        $this->category_id = $category_id;
    }
}
