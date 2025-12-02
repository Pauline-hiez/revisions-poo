<?php

require_once "Product.php";

class Electronic extends Product
{
    private string $brand;
    private int $waranty_fee;

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
    }
}
