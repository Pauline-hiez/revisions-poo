<?php

abstract class AbstractProduct
{
    protected int $id;
    protected string $name;
    protected array $photos;
    protected int $price;
    protected string $description;
    protected int $quantity;
    protected int $category_id;
    protected DateTime $created_at;
    protected DateTime $updated_at;


    //GETTERS & SETTERS
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCategory()
    {
        require_once __DIR__ . '/../job-02/Category.php';
        return Category::findOneById($this->category_id);
    }

    abstract public function findOneById(int $id);
    abstract public function findAll();
    abstract public function create();
    abstract public function update();
}
