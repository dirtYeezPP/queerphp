<?php

$db = './databas/database.sqlite';
$dsn = "sqlite:$db";

// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

try{
    $pdo = new \PDO($dsn);
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS poems (
            id INTEGER PRIMARY KEY AUTOINCREMENT, 
            title TEXT,
            genre TEXT, 
            poem TEXT NOT NULL, 
            pImg TEXT,
            published TEXT NOT NULL, 
            createdById INT NOT NULL 
        ); 

        CREATE TABLE IF NOT EXISTS users (
            userId INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL,
            pseudonym TEXT,
            email TEXT NOT NULL, 
            hashedPassword VARCHAR(255) NOT NULL 
        ); 
    "); 
} catch (\PDOException $e) {
    // echo "" . $e->getMessage() . ""; 
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}

