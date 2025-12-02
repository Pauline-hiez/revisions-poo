<?php

class Clothing extends AbstractProduct
{
    public function __construct() {}
    protected string $size;
    protected string $color;
    protected string $type;
    protected int $material_fee;

    public function findOneById(int $id)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM product WHERE id = ?");
        $stmt->execute([$id]);
        $productData = $stmt->fetch();

        if (!$productData) return false;

        $stmt = $pdo->prepare("SELECT * FROM clothing WHERE product_id = ?");
        $stmt->execute([$id]);
        $clothingData = $stmt->fetch();

        if (!$clothingData) return false;

        $this->id = $productData['id'];
        $this->name = $productData['name'];
        $this->photos = $productData['photos'];
        $this->price = $productData['price'];
        $this->description = $productData['description'];
        $this->quantity = $productData['quantity'];
        $this->category_id = $productData['category_id'];
        // $this->createdAt = $productData['createdAt'];
        // $this->updatedAt = $productData['updatedAt'];
        $this->size = $clothingData['size'];
        $this->color = $clothingData['color'];
        $this->type = $clothingData['type'];
        $this->material_fee = $clothingData['material_fee'];

        return $this;
    }


    public function findAll()
    {
        global $pdo;
        $result = [];

        $stmt = $pdo->query("
        SELECT * FROM product 
        INNER JOIN clothing ON product.id = clothing.product_id
    ");

        while ($row = $stmt->fetch()) {
            $cl = new Clothing();

            $cl->id = $row['id'];
            $cl->name = $row['name'];
            $cl->photos = $row['photos'];
            $cl->price = $row['price'];
            $cl->description = $row['description'];
            $cl->quantity = $row['quantity'];
            $cl->category_id = $row['category_id'];
            // $cl->createdAt = $row['createdAt'];
            // $cl->updatedAt = $row['updatedAt'];
            $cl->size = $row['size'];
            $cl->color = $row['color'];
            $cl->type = $row['type'];
            $cl->material_fee = $row['material_fee'];

            $result[] = $cl;
        }

        return $result;
    }


    public function create()
    {
        global $pdo;

        $stmt = $pdo->prepare("
        INSERT INTO product (name, photos, price, description, quantity, category_id, createdAt, updatedAt)
        VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
    ");

        $success = $stmt->execute([
            $this->name,
            $this->photos,
            $this->price,
            $this->description,
            $this->quantity,
            $this->category_id
        ]);

        if (!$success) return false;

        $this->id = $pdo->lastInsertId();

        $stmt = $pdo->prepare("
        INSERT INTO clothing (product_id, size, color, type, material_fee)
        VALUES (?, ?, ?, ?, ?)
    ");

        $success = $stmt->execute([
            $this->id,
            $this->size,
            $this->color,
            $this->type,
            $this->material_fee
        ]);

        return $success ? $this : false;
    }


    public function update()
    {
        global $pdo;

        $stmt = $pdo->prepare("
        UPDATE product SET 
            name = ?, photos = ?, price = ?, description = ?, quantity = ?, category_id = ?, updatedAt = NOW()
        WHERE id = ?
    ");

        $success = $stmt->execute([
            $this->name,
            $this->photos,
            $this->price,
            $this->description,
            $this->quantity,
            $this->category_id,
            $this->id
        ]);

        if (!$success) return false;

        $stmt = $pdo->prepare("
        UPDATE clothing SET 
            size = ?, color = ?, type = ?, material_fee = ?
        WHERE product_id = ?
    ");

        return $stmt->execute([
            $this->size,
            $this->color,
            $this->type,
            $this->material_fee,
            $this->id
        ]);
    }
}
