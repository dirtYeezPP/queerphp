<?php

require_once 'router.php';
require_once 'source/connect.php';
require_once 'source/helpers.php';
global $pdo;

session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Lax']);

$isLoggedIn = isset($_SESSION['id']);
$username = $isLoggedIn ? $_SESSION['name'] : null;
$userId = $isLoggedIn ? $_SESSION['id'] : null;

App::get("/", function () {
    include('views/home.php');
});

App::get("/poems", function () use ($pdo) {

    $sql = "
        SELECT 
            p.id, p.title, p.genre, p.poem, p.pImg, p.published, p.createdById,
            u.pseudonym, u.username
        FROM poems p 
        LEFT JOIN users u ON p.createdById = u.userId
    ";

    $stmt = $pdo->query($sql);
    $poems = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $poems[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'genre' => $row['genre'],
            'poem' => $row['poem'],
            'pImg' => $row['pImg'],
            'published' => $row['published'],
            'createdById' => $row['createdById'],
            'pseudonym' => $row['pseudonym'],
            'username' => $row['username'] ?? ''
        ];
    }

    include("views/poems.php");
});

App::post("/poems", function () use ($pdo, $userId) {
    header('Content-Type: application/json');
    // $newPoem = json_decode(file_get_contents('php://input'), true);

    if (!isset($_FILES['pImg']) || $_FILES['pImg']['error'] != UPLOAD_ERR_OK) {
        Errors::sendJsonFormatErr('ERR_INVALID_DATA');
        exit;
    }

    $allowedExes = ['png', 'jpg', 'jpeg', 'gif', 'webp'];
    $fileName = basename($_FILES['pImg']['name']);
    $tmpName = $_FILES['pImg']['tmp_name'];
    $fileEx = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $tmpName);
    finfo_close($finfo);

    $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mimeType, $allowedMimes)) {
        Errors::sendJsonFormatErr('ERR_INVALID_DATA');
        exit;
    }

    if (!in_array($fileEx, $allowedExes)) {
        Errors::sendJsonFormatErr('ERR_INVALID_DATA');
        exit;
    }

    $uniqueFileName = 'posts/' . uniqid('pic_') . '.' . $fileEx;
    if (!move_uploaded_file($_FILES['pImg']['tmp_name'], (__DIR__ . "/" . $uniqueFileName))) {
        Errors::sendJsonFormatErr('ERR_UPLOAD_FAIL');
        exit;
    }

    $req = [
        'title' => $_POST['title'],
        'genre' => $_POST['genre'],
        'poem' => $_POST['poem'],
        'pImg' => $uniqueFileName,
        'published' => date('Y/m/d H:i:s'),
        'createdById' => $userId
    ];

    $sql = "INSERT INTO poems (title, genre, poem, pImg, published, createdById) VALUES (:title, :genre, :poem, :pImg, :published, :createdById )";
    $pdo->prepare($sql)->execute($req);

    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'message' => 'Success!!!!'
    ]);
    exit;
});

App::delete("/poems", function () use ($pdo) {
    parse_str(file_get_contents('php://input'), $_DELETE);
    $poemId = $_DELETE['id']; 
    $stmt = $pdo->query("SELECT img FROM poems WHERE id=:id");
    $img = $stmt->fetchColumn(); 

    unlink(__DIR__."/".$img); 
    $pdo->prepare("DELETE FROM poems WHERE id=?")->execute([$poemId]);
});

App::patch("/poems", function () {
    
});

// Auth 

App::get("/auth", function () {

});

App::post("/auth/register", function () use ($pdo) {
    header('Content-Type: application/json');
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $req = [
        'username' => $_POST['username'],
        'pseudonym' => $_POST['pseudonym'],
        'email' => $_POST['email'],
        'hashedPassword' => $hashedPassword
    ];

    $checksql = "SELECT * FROM users WHERE email = :email";
    $checkStmt = $pdo->prepare($checksql);
    $checkStmt->execute(['email' => $req['email']]);

    $emailExists = $checkStmt->fetchColumn() > 0;
    if ($emailExists) {
        Errors::sendJsonFormatErr('ERR_INCORRECT_DATA');
        exit;
    }

    $sql = "INSERT INTO users (username, pseudonym, email, hashedPassword) VALUES (:username, :pseudonym, :email, :hashedPassword)";
    $pdo->prepare($sql)->execute($req);

    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'message' => 'Success!!!!'
    ]);
    exit;
});

App::post("/auth/login", function () use ($pdo) {
    header('Content-Type: application/json');
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users where email=:email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['hashedPassword'])) {
        $_SESSION['id'] = $user['userId'];
        $_SESSION['name'] = $user['username'];
    } else {
        Errors::sendJsonFormatErr('ERR_INCORRECT_DATA');
        exit;
    }

    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'message' => 'Success!!!!'
    ]);
    exit;
});

App::get("/auth/logout", function () {
    $_SESSION = [];
    session_destroy();
}); 

// App::get('/errors/$errorCode', function ($errorCode) {});
