<?php

declare(strict_types=1);

require_once 'src/Entities/Category.php';
require_once 'src/Entities/User.php';
require_once 'src/Entities/Post.php';
class FormsService {

    public static function registrationForm(): string
    {
        return "<div>Register</div>
                    <form method='post'>
                    <label for='username'>Username</label>
                    <input name='username' type='text' id='username' />
                    <label for='password'>Password</label>
                    <input name='password' type='password' id='password' />
                    <input type='submit' value='Register' name='registerSubmitted' />
                </form>";
    }

    public static function logInForm(): string
    {
        return "<div>Log In</div>
                <form method='post'>
                    <label for='''usernameLog'>Username</label>
                    <input name='usernameLog' type='text' id='usernameLog' />
                    <label for='passwordLog'>Password</label>
                    <input name='passwordLog' type='password' id='passwordLog' />
                    <input type='submit' value='Log In' name='logInSubmitted'/>
                </form>";
    }

    /**
     * @param Post $post
     * @param Category[] $categoryIDs
     * @param User[] $userIDs
     */
    public static function editPostForm(Post $post, array $categoryIDs, array $userIDs): string
    {
        $categories = '';
        foreach($categoryIDs as $categoryID){
            $categories .= "<option value={$categoryID->getID()}>{$categoryID->getName()}</option>";
        }
        $users = '';
        foreach($userIDs as $userID){
            $users .= "<option value={$userID->getId()}>{$userID->getUsername()}</option>";
        }

        return "<form method='post'>
                <label for='title'>Title</label>
                <input type='text' name='title' id='title' placeholder={$post->getTitle()}>
                <label for='image'>Image URL</label>
                <input type='text' name='image' id='image' placeholder={$post->getImage()}>
                <label for='category'>Category</label>
                <select name='category' id='category'>
                    <option>Select Category</option>
                    {$categories}
                </select>
                <label for='author'>Author</label>
                <select name='author' id='author'>
                    <option>Select Username</option>
                    {$users}
                </select>
                <label for='content'>Content</label>
                <input type='text' name='content' id='content' placeholder={$post->getContent()}>
                <input type='submit' value='Update Post' name='submitted'>
            </form>
            <a href='home.php'><button>Back to Posts</button></a>";
    }

    public static function addCategory(): string
    {
        return "<form method='post'>
                    <label for='category'>New Category</label>
                    <input name='category' type='text' id='category' />
                    <input type='submit' value='Add Category' name='categorySubmitted' />
                </form>";
    }

    /**
     * @param User[] $userIDs
     * @param Category[] $categoryIDs
     */
    public static function addPost(array $userIDs, array $categoryIDs): string
    {
        $users = '';
        foreach($userIDs as $userID){
            $users .= "<option value={$userID->getId()}>{$userID->getUsername()}</option>";
        }
        $categories = '';
        foreach($categoryIDs as $categoryID){
            $categories .= "<option value={$categoryID->getID()}>{$categoryID->getName()}</option>";
        }

        return "<form method='post'>
                    <label for='title'>Post Title</label>
                    <input name='title' type='text' id='title' />
                    <label for='user_id'>User ID</label>
                    <select name='user_id' id='user_id'>
                        <option>Select Username</option>
                        {$users}
                    </select>
                    <label for='category_id'>Category ID</label>
                    <select name='category_id' id='category_id'>
                        <option>Select Category</option>
                        {$categories}
                    </select>
                    <label for='content'>Content</label>
                    <input name='content' type='text' id='content' />
                    <label for='image'>Image</label>
                    <input name='image' type='text' id='image' />
                    <input type='submit' value='Add Post' name='postSubmitted' />
                </form>";
    }
}