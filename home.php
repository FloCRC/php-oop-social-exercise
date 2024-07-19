<?php

declare(strict_types=1);

session_start();

require_once 'src/DatabaseConnector.php';
require_once 'src/Models/PostsModel.php';
require_once 'src/Models/CategoriesModel.php';
require_once 'src/Models/UsersModel.php';
require_once 'src/Services/PostDisplayService.php';
require_once 'src/Services/FormsService.php';

$db = DatabaseConnector::connect();

$postsModel = new PostsModel($db);
$categoryModel = new CategoriesModel($db);
$usersModel = new UsersModel($db);

if (isset($_POST['categorySubmitted'])){
    $inputtedCategory = $_POST['category'];
    if ($categoryModel->addCategory($inputtedCategory)) {
        echo 'New category added to database.';
    }
    else {
        echo "Didn't work mate.";
    }
}

if (isset($_SESSION['loggedIn'])) {
    if (isset($_POST['postSubmitted'])) {
        $inputtedTitle = $_POST['title'];
        $inputtedUserID = $_SESSION['userId'];
        $inputtedCategoryID = (int)$_POST['category_id'];
        $inputtedContent = $_POST['content'];
        $inputtedImage = $_POST['image'];
        if ($postsModel->addPost($inputtedTitle, $inputtedUserID, $inputtedCategoryID, $inputtedContent, $inputtedImage)) {
            echo 'New post added to database.';
        } else {
            echo "Didn't work mate.";
        }
    }
}
else {
    echo "Please log in if you'd like to add a post.";
}

if (isset($_GET['id'])){
    $idToDelete = (int)$_GET['id'];
    if ($postsModel->deletePost($idToDelete)) {
        echo 'This post has been deleted.';
    }
    else {
        echo "Didn't work mate.";
    }
}

if (isset($_POST['logOutSubmitted'])){
    session_destroy();
    header( 'Location: home.php');
    echo 'You have logged out';
}

$posts = $postsModel->getPosts();
$categoryIDs = $categoryModel->getCategoryIDs();
$userIDs = $usersModel->getUserIDs();

echo PostDisplayService::displayPosts($posts);
echo FormsService::addCategory();
echo FormsService::addPost($userIDs, $categoryIDs);

if (isset($_SESSION['loggedIn'])) {
    echo "<form method='post'>
            <input type='submit' value='Log Out' name='logOutSubmitted' />
          </form>";
}
else {
    echo "<a href='index.php'><button>Log In</button></a>";
}