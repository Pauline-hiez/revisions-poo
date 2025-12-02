<?php

class Electronic extends AbstractProduct
{
    public function __construct() {}
    protected string $brand;
    protected int $waranty_fee;

    public function findOneById(int $id)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM product WHERE id = ?");
        $stmt->execute([$id]);
        $productData = $stmt->fetch();

        if (!$productData) return false;

        $stmt = $pdo->prepare("SELECT * FROM electronic WHERE product_id = ?");
        $stmt->execute([$id]);
        $electronicData = $stmt->fetch();

        if (!$electronicData) return false;

        $this->id = $productData['id'];
        $this->name = $productData['name'];
        $this->photos = $productData['photos'];
        $this->price = $productData['price'];
        $this->description = $productData['description'];
        $this->quantity = $productData['quantity'];
        $this->category_id = $productData['category_id'];
        // $this->createdAt = $productData['createdAt'];
        // $this->updatedAt = $productData['updatedAt'];

        $this->brand = $electronicData['brand'];
        $this->waranty_fee = $electronicData['waranty_fee'];

        return $this;
    }

    public function findAll()
    {
        global $pdo;
        $result = [];

        $stmt = $pdo->query("
        SELECT * FROM product 
        INNER JOIN electronic ON product.id = electronic.product_id
    ");

        while ($row = $stmt->fetch()) {
            $el = new Electronic();

            $el->id = $row['id'];
            $el->name = $row['name'];
            $el->photos = $row['photos'];
            $el->price = $row['price'];
            $el->description = $row['description'];
            $el->quantity = $row['quantity'];
            $el->category_id = $row['category_id'];
            // $el->createdAt = $row['createdAt'];
            // $el->updatedAt = $row['updatedAt'];

            $el->brand = $row['brand'];
            $el->waranty_fee = $row['waranty_fee'];

            $result[] = $el;
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
        INSERT INTO electronic (product_id, brand, waranty_fee)
        VALUES (?, ?, ?)
    ");

        $success = $stmt->execute([
            $this->id,
            $this->brand,
            $this->waranty_fee
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
        UPDATE electronic SET 
            brand = ?, waranty_fee = ?
        WHERE product_id = ?
    ");

        return $stmt->execute([
            $this->brand,
            $this->waranty_fee,
            $this->id
        ]);
    }
}
