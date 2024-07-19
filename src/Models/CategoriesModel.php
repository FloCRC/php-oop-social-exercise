<?php

declare(strict_types=1);

require_once 'src/Entities/Category.php';

class CategoriesModel {
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getCategoryIDs(): array
    {
        $query = $this->db->prepare("SELECT `id`, `name` FROM `categories`;");
        $query->setFetchMode(PDO::FETCH_CLASS, Category::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function addCategory($category): bool
    {
        $query = $this->db->prepare("INSERT INTO `categories` (`name`) VALUES (:category);");
        return $query->execute(['category' => $category]);
    }

}