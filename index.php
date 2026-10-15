<?php

require_once 'router.php';
require_once 'source/connect.php';
require_once 'source/helpers.php';
global $pdo;

App::get("/", function () {
    include('view.php');
});

App::get("/poems", function () use($pdo) {

    $sql = "
        SELECT 
            p.id, p.title, p.genre, p.poem, p.pImg, p.published, p.createdById,
            u.pseudonym, u.username
        FROM poems p 
        LEFT JOIN users u ON p.createdById = u.userId
    "; 

    $stmt = $pdo->query($sql);
    $poems = []; 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $poems[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'genre' => $row['genre'],
            'poem'=>$row['poem'],
            'createdById'=>$row['createdById'],
            'pseudonym'=>$row['pseudonym'],
            'username'=>$row['username'] ?? ''
        ]; 
    }

    include("view.php"); 

});

App::post("/poems", function () use ($pdo) {
    header('Content-Type: application/json');
    $newPoem = json_decode(file_get_contents('php://input'), true);

    if(!isset($_FILES['pImg']) || $_FILES['pImg']['error'] != UPLOAD_ERR_OK){
        echo json_encode(['status'=>'error', 'message'=>'youre gay']); 
    }

    $req = [
        "title" => $newPoem['title'] ?? '',
        "genre" => $newPoem['genre'] ?? '',
        "poem" => $newPoem['poem'] ?? '',
        "pImg"=>PATHS::RESOURCES_PATH.$newPoem["pImg"],
        "published" => date("Y-m-d H:i:s"),
        "createdById" => (int) 1
    ];

    if (empty($req['title']) || empty($req['poem'])) {
        Errors::sendJsonFormatErr('ERR_INVALID_DATA'); 
        exit; 
    } 

    try{
        $sql = "INSERT INTO poems (title, genre, poem, pImg, published, createdById) VALUES (:title, :genre, :poem, :pImg, :published, :createdById);";
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
    
    // Res::redirect("/animes"); 
});

App::delete("/poems", function () {});

App::patch("/poems", function () {});

// Auth 

App::get("/auth", function () {});

App::post("/auth/register", function () {});

App::post("/auth/login", function () {});

App::get('/errors/$errorCode', function($errorCode){

});