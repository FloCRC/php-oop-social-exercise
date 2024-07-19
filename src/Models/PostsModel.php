<?php

declare(strict_types=1);

require_once 'src/Entities/Post.php';
class PostsModel {
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getPosts(): array
    {
        $query = $this->db->prepare(
            "SELECT `posts`.`id`, `posts`.`title`, `posts`.`image`, `categories`.`name` AS 'category', `users`.`username`
	                    FROM `posts`
		                    INNER JOIN `categories`
			                    ON `posts`.`category_id` = `categories`.`id`
				                    INNER JOIN `users`
					                    ON `posts`.`user_id` = `users`.`id`;");
        $query->setFetchMode(PDO::FETCH_CLASS, Post::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function getPost(int $id): Post
    {
        $query = $this->db->prepare("SELECT `posts`.`id`, `posts`.`title`, `posts`.`image`, `posts`.`content`, `categories`.`name` AS 'category', `users`.`username` FROM `posts`
    		INNER JOIN `categories`
                ON `posts`.`category_id` = `categories`.`id`
				    INNER JOIN `users`
					    ON `posts`.`user_id` = `users`.`id` WHERE `posts`.`id` = $id;");
        $query->setFetchMode(PDO::FETCH_CLASS, Post::class);
        $query->execute();
        return $query->fetch();
    }

    public function addPost(string $title, int $userID, int $categoryID, string $content, string $image): bool
    {
        $query = $this->db->prepare("INSERT INTO `posts` (`title`, `user_id`, `category_id`, `content`, `image`) VALUES (:title, :userID, :categoryID, :content, :image);");
        return $query->execute(['title' => $title, 'userID' => $userID, 'categoryID' => $categoryID, 'content' => $content, 'image' => $image]);
    }

    public function updatePost(string $title, int $author, int $category, string $content, string $image, int $id): bool
    {
        $query = $this->db->prepare("UPDATE `posts` SET `title` = :title, `user_id` = :author, `category_id` = :category, `content` = :content, `image` = :image WHERE `id` = $id;");
        return $query->execute(['title' => $title, 'author' => $author, 'category' => $category, 'content' => $content, 'image' => $image]);
        }

    public function deletePost(int $id): bool
    {
        $query = $this->db->prepare("DELETE FROM `posts` WHERE `id` = :toDelete;");
        return $query->execute(['toDelete' => $id]);
    }

}