<?php

declare(strict_types=1);

require_once 'src/DatabaseConnector.php';
require_once 'src/Models/UsersModel.php';
require_once 'src/Models/PostsModel.php';
require_once 'src/Services/PostDisplayService.php';

$db = DatabaseConnector::connect();

$usersModel = new UsersModel($db);
$userIDs = $usersModel->getUserIDs();

$id = (int)$_GET['id'];

$postsModel = new PostsModel($db);
$post = $postsModel->getPost($id);

echo PostDisplayService::displayPost($post);