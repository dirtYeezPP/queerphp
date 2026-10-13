<?php

require_once 'router.php';
require_once 'source/connect.php';
require_once 'source/helpers.php';
global $pdo;

App::get("/", function () {
    include('view.php');
});

App::get("/animes", function () {});

App::post("/animes", function () use ($pdo) {
    header('Content-Type: application/json');

    $req = [
        'title' => $_POST['title'],
        'atype' => $_POST['atype'],
        'published' => $_POST['published'],
        'rating' => $_POST['rating'],
        'postedById' => 1
    ];

    $sql = "INSERT INTO animes (title, atype, published, rating, postedById) VALUES (:title, :atype, :published, :rating, :postedById)";
    $pdo->prepare($sql)->execute($req);
    Res::redirect("animes");

    if (empty($req['title']) || empty($req['atype']) || empty($req['published']) || empty($req['rating'])) {
        Errors::sendErrPath('ERR_INVALID_DATA');
        Res::redirect('errors/ERR_INVALID_DATA');
    } else {
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'Location' => 'http://localhost:8000/animes'
        ]);
    }
});

App::delete("/animes", function () {});

App::patch("/animes", function () {});

// Auth 

App::get("/auth", function () {});

App::post("/auth/register", function () {});

App::post("/auth/login", function () {});
