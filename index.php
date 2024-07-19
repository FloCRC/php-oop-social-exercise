<?php

declare(strict_types=1);

session_start();

require_once 'src/DatabaseConnector.php';
require_once 'src/Models/UsersModel.php';
require_once 'src/Services/FormsService.php';

$db = DatabaseConnector::connect();

$usersModel = new UsersModel($db);

if (isset($_POST['registerSubmitted'])){
    $inputtedUsername = $_POST['username'];
    $safePassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
    if ($usersModel->addUser($inputtedUsername, $safePassword)) {
        echo "Registration Successful.";
    }
    else {
        echo "Didn't work mate.";
    }
}

if (isset($_POST['logInSubmitted'])) {
    $username = (string)$_POST['usernameLog'];
    $user = $usersModel->getUser($username);
    $storedPassword = $user->getPassword();
    if(password_verify($_POST['passwordLog'], $storedPassword)){
        $_SESSION['loggedIn'] = true;
        $_SESSION['userId'] = $user->getId();
        header( 'Location: home.php');
    }
    else {
        echo 'Incorrect username or password. Try again.';
    }
}

echo FormsService::registrationForm();
echo FormsService::logInForm();