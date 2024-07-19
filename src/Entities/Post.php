<?php

declare(strict_types=1);

class Post{
    private int $id;
    private string $title;
    private string $image;
    private string $category;
    private string $username;
    private string $content;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}