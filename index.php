<?php

require_once 'router.php';
require_once 'source/connect.php';
require_once 'source/helpers.php';
global $pdo;

App::get("/", function () {
    include('view.php');
});

App::get("/animes", function () {

});

App::post("/animes", function () use ($pdo) {
    header('Content-Type: application/json');
    $newAnime = json_decode(file_get_contents('php://input'), true);

    $req = [
        "title" => $newAnime['title'] ?? '',
        "atype" => $newAnime['atype'] ?? '',
        "published" => (int) $newAnime['published'],
        "rating" => (int) $newAnime['rating'],
        "createdById" => (int) 1
    ];

    if (empty($req['title']) || empty($req['atype']) || empty($req['published']) || empty($req['rating'])) {
        Errors::sendJsonFormatErr('ERR_INVALID_DATA'); 
        exit; 
    } 

    try{
        $sql = "INSERT INTO animes (title, atype, published, rating, createdById) VALUES (:title, :atype, :published, :rating, :createdById);";
        $pdo->prepare($sql)->execute($req);

        http_response_code(200);
        echo json_encode([
            'status'=>'success',
            'message'=>'Success!!!!'
        ]);
        exit;
    } catch (Exception $e){
        http_response_code(500);
        echo json_encode(['status'=>'error', 'message'=>'Databaase error']); 
        exit; 
    }



    Res::redirect("/animes"); 
});

App::delete("/animes", function () {});

App::patch("/animes", function () {});

// Auth 

App::get("/auth", function () {});

App::post("/auth/register", function () {});

App::post("/auth/login", function () {});

App::get('/errors/$errorCode', function($errorCode){

});