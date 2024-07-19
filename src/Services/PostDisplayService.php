<?php

declare(strict_types=1);

require_once 'src/Entities/Post.php';

class PostDisplayService {

    /**
     * @param Post $post
     */
    public static function displayPost(Post $post): string
    {
        return "<div>
                    <h2>{$post->getTitle()}</h2>
                    <img src='{$post->getImage()}'>
                    <p>Category: {$post->getCategory()} - Author: {$post->getUsername()}</p>
                    <p>{$post->getContent()}</p>
                    <a href='home.php'><button>Back to Posts</button></a>
                </div>";
    }

    /**
     * @param Post[] $posts
     */
    public static function displayPosts(array $posts): string
    {
        $postsDisplay = '';
        foreach($posts as $post) {
            $postsDisplay .= "<div>
            <h2>{$post->getTitle()}</h2>
            <p>Category: {$post->getCategory()} - Author: {$post->getUsername()}</p>
            <img src='{$post->getImage()}'>
            <a href='post.php?id={$post->getId()}'>Click for more info</a>
            <a href='edit.php?id={$post->getId()}'><button>Edit</button></a>
            <a href='home.php?id={$post->getId()}'><button>Delete</button></a>
          </div>";
        }
        return $postsDisplay;
    }
}