<?php

declare(strict_types=1);

require_once 'src/DatabaseConnector.php';
require_once 'src/Models/PostsModel.php';
require_once 'src/Models/CategoriesModel.php';
require_once 'src/Models/UsersModel.php';
require_once 'src/Services/FormsService.php';

$db = DatabaseConnector::connect();

$id = (int)$_GET['id'];

$postsModel = new PostsModel($db);
$post = $postsModel->getPost($id);
$categoryModel = new CategoriesModel($db);
$categoryIDs = $categoryModel->getCategoryIDs();
$usersModel = new UsersModel($db);
$userIDs = $usersModel->getUserIDs();

if (isset($_POST['submitted'])){
    $inputtedTitle = $_POST['title'];
    $inputtedImage = $_POST['image'];
    $inputtedCategory = (int)$_POST['category'];
    $inputtedAuthor = (int)$_POST['author'];
    $inputtedContent = $_POST['content'];
    if ($postsModel->updatePost($inputtedTitle, $inputtedAuthor, $inputtedCategory, $inputtedContent, $inputtedImage, $id)) {
        echo "The post has been edited.";
    }
    else {
        echo "Didn't work mate.";
    }
}

echo FormsService::editPostForm($post, $categoryIDs, $userIDs);