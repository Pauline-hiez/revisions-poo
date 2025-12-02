<?php

class Electronic extends AbstractProduct implements SockableInterface
{
    protected string $brand;
    protected int $waranty_fee;

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
