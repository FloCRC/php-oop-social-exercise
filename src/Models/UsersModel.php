<?php

declare(strict_types=1);

require_once 'src/Entities/User.php';
class UsersModel {
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getUserIDs(): array
    {
        $query = $this->db->prepare("SELECT `id`, `username` FROM `users`;");
        $query->setFetchMode(PDO::FETCH_CLASS, User::class);
        $query->execute();
        return $query->fetchAll();
    }

        public function addUser(string $username, string $password): bool
    {
        $query = $this->db->prepare("INSERT INTO `users` (`username`, `password`) VALUES (:username, :password);");
        return $query->execute(['username' => $username, 'password' => $password]);
    }

    public function getUser(string $username): User
    {
        $query = $this->db->prepare("SELECT `id`, `username`, `password` FROM `users` WHERE `username` = :username;");
        $query->setFetchMode(PDO::FETCH_CLASS, User::class);
        $query->execute(['username' => $username]);
        return $query->fetch();
    }

}