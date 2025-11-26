<?php
namespace App\Controllers;

use App\Config;

class GuestbookController
{
    public function getAll() 
    {
        try {
            // 1. Connect to Database
            $connection = new \PDO(
                'mysql:host=' . Config::DB_SERVER_NAME . ';dbname=' . Config::DB_NAME . ';charset=utf8mb4',
                Config::DB_USERNAME,
                Config::DB_PASSWORD
            );
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // 2. Get Data
            $sql = 'SELECT * FROM posts ORDER BY posted_at DESC';
            $result = $connection->query($sql);
            $posts = $result->fetchAll(\PDO::FETCH_ASSOC);

            // 3. Show View
            require(__DIR__ .'/../Views/guestbook.php');

        } catch (\PDOException $e) {
            die("Database Connection Failed: " . $e->getMessage());
        }
    }

    // CREATE: Save a new post
    public function create() 
    {
        try {
            // 1. Connect to Database
            $connection = new \PDO(
                'mysql:host=' . Config::DB_SERVER_NAME . ';dbname=' . Config::DB_NAME . ';charset=utf8mb4',
                Config::DB_USERNAME,
                Config::DB_PASSWORD
            );
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // 2. Collect Data
            $name = $_POST['name'] ?? 'Anonymous';
            $message = $_POST['message'] ?? '';
            $email = $_POST['email'] ?? '';

            // 3. Insert Data (Prepared Statement to prevent SQL Injection)
            $stmt = $connection->prepare("INSERT INTO posts (name, email, message) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $message]);

            // 4. Redirect back to guestbook
            header("Location: /guestbook");
            exit;

        } catch (\PDOException $e) {
            die("Database Error: " . $e->getMessage());
        }
    }     
}