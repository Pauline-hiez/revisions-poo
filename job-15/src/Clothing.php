<?php

namespace App;

use App\AbstractProduct;
use App\StockableInterface;
use \Exception;
use \DateTime;


class Clothing extends AbstractProduct implements StockableInterface
{
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
    protected string $size;
    protected string $color;
    protected string $type;
    protected int $material_fee;

    public function addStocks(int $stock): self
    {
        $this->quantity += $stock;
        return $this;
    }

    public function removeStocks(int $stock): self
    {
        if ($this->quantity - $stock < 0) {
            throw new Exception("Impossible de retirer plus de stock que disponible !");
        }

        $this->quantity -= $stock;
        return $this;
    }

    public function findOneById(int $id)
    {

        return null;
    }

    public function findAll()
    {

        return [];
    }

    public function create()
    {

        return false;
    }

    public function update()
    {

        return false;
    }
}
