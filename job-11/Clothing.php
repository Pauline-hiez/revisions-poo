<?php

require_once "Product.php";

class Clothing extends Product
{
    private string $size;
    private string $color;
    private string $type;
    private int $material_fee;

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
        $size,
        $color,
        $type,
        $material_fee,
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
    }
}
