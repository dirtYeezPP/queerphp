<?php

$db = './databas/database.sqlite';
$dsn = "sqlite:$db";

// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

try{
    $pdo = new \PDO($dsn);
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS animes (
            id INTEGER PRIMARY KEY AUTOINCREMENT, 
            title TEXT NOT NULL,
            atype TEXT NOT NULL,
            published TEXT NOT NULL, 
            rating INT NOT NULL, 
            createdById INT NOT NULL 
        ); 

        CREATE TABLE IF NOT EXISTS users (
            userId INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL,
            email TEXT NOT NULL, 
            hashP VARCHAR(255) NOT NULL 
        ); 
    "); 
} catch (\PDOException $e) {
    echo "" . $e->getMessage() . ""; 
}

