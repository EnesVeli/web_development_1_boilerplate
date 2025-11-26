<?php
namespace App\Controllers;

use App\Config;

class GuestbookController
{
    public function getAll() 
    {
        $connection = null;
        try{
            // create a new connection string
            $connectionString = 'mysql:host=' . Config::DB_SERVER_NAME . ';dbname=' . Config::DB_NAME . ';charset=utf8mb4';
            // create a new PDO instance
            $connection = new \PDO
            ($connectionString, Config::DB_USERNAME,
            Config::DB_PASSWORD
        );
        // tell PDO to throw exceptions on error
        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        // echo "Database connection established succesfully.";
        //} catch(\PDOException $e){
        // Handle connection error
        //die("Database connection failed: " . $e->getMessage());
        }
        $sql = 'SELECT id, posted_at, name, email, message FROM posts';
        $result = $connection->query($sql);
        $posts = $result->fetchAll(\PDO::FETCH_ASSOC);
        
        //var_dump($posts);
        //die('');

        require(__DIR__ .'/../Views/guestbook.php');
        } catch (\PDOException $e){
        // Handle query error
        die("Database Connection Failed " . $e->getMessage());
        }
}
            
   