<?php

$pdo = new PDO('sqlite:database.sqlite');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$pdo->exec("CREATE TABLE IF NOT EXISTS animes (
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    title TEXT ")