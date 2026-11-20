<?php

require_once 'router.php';
require_once 'source/connect.php';
require_once 'source/helpers.php';
require_once 'source/poemRepo.php'; // all sql for poems
require_once 'source/imageUploader.php'; // all logic for upload files 
require_once 'source/userRepo.php'; // all sql for users
global $pdo;

// httponly means JS cant read the session cookie (XSS)
// samesite = the cookie isnt sent along from other sites forms (CSRF)
// session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Lax']);
session_start(); 

$isLoggedIn = isset($_SESSION['id']);
$username = $isLoggedIn ? $_SESSION['name'] : null;
$userId = $isLoggedIn ? $_SESSION['id'] : null;

// create repositories once
$repo = new PoemRepository($pdo); 
$users = new UserRepository($pdo); 

App::get("/", function () use($userId) {
    include('views/home.php');
});

App::get("/poems", function () use ($repo, $userId) {
    $poems = $repo->all(); 
    include 'views/poems.php'; //$userId needed for ts
});

App::post("/poems", function () use ($repo, $userId) {
    requireLogin($userId); 

    $title = trim($_POST['title'] ?? ''); 
    $genre = trim($_POST['genre'] ?? '');
    $poem = trim($_POST['poem'] ?? '');

    if($title === '' || $genre === '' || $poem === '') {
        Errors::sendJsonFormatErr('ERR_MISSING_DATA'); 
        exit; 
    }

    $img = ImageUploader::save($_FILES['pImg'] ?? null); 
    if(!$img){
        Errors::sendJsonFormatErr('ERR_INVALID_DATA'); 
        exit; 
    }

    $repo->create([
        'title' => $title, 
        'genre' => $genre, 
        'poem' => $poem, 
        'pImg' => $img, 
        'published' => date('Y-m-d H:i:s'), 
        'createdById' => $userId,
    ]); 

    jsonSuccess('Poem Created! yayy'); 
});

App::delete("/poems", function () use ($pdo) {
    requireLogin($userId);
    parse_str(file_get_contents('php://input'), $data); 
    $poem = $repo->findOwned((int)($data['id'] ?? 0), $userId); 
    if(!$poem) {
        Errors::sendJsonFormatErr('ERR_INVALID_DATA'); 
        exit; 
    }

    ImageUploader::delete($poem['pImg']); 
    $repo->delete($poem['id'], $userId); 

    jsonSuccess('Poem deleted'); 
});

App::post("/poems/update", function () use ($repo, $userId) {
    requireLogin($userId); 
    $poem = $repo->findOwned((int)($_POST['id'] ?? 0), $userId); 
    if(!$poem) {
        Errors::sendJsonFormatErr('ERR_MISSING_DATA'); 
        exit; 
    }

    $fields = array_filter([
        'title' => trim($_POST['title'] ?? ''), 
        'genre' => trim($_POST['genre'] ?? ''), 
        'poem' => trim($_POST['poem'] ?? '')
    ], fn($value) => $value !=== '');

    $hasNewImg = isset($_FILES['pImg']) && $_FILES['pImg']['error'] !== UPLOAD_ERR_NO_FILE;
    if($hasNewImg) {
        $newImg = ImageUploader::save($_FILES['pImg']); 
        if(!$newImg) {
            Errors::sendJsonFormatErr('ERR_INVALID_DATA'); 
            exit; 
        }
        $fields['pImg'] = $newImg; 
    }

    $repo->update($poem['id'], $userId, $fields); 
    if($hasNewImg) {
        ImageUploader::delete($poem['pImg']); 
    }
    jsonSuccess('poem updated yay'); 
});

App::get('poems/edit', function() use($repo, $userId) {
    if(!$userId) {
        header('Location: /'); 
        exit; 
    }
    $poem = $repo->findOwned((int)($_GET['id'] ?? 0), $userId); 
    if(!$poem) {
        header('Location: /me'); 
        exit; 
    }

    include 'views/editPoem.php'; 
})

// Auth 

App::get("/me", function () use ($repo, $userId, $username) {
    if(!$userId) {
        header('Location: /'); 
        exit;
    }
    $userPoems = $repo->byUser($userId); 
    include 'views/profile.php'; 
});

App::post("/auth/register", function () use ($users) {
    $username = trim($_POST['username'] ?? ''); 
    $pseudonym = trim($_POST['pseudonym'] ?? ''); 
    $email = trim($_POST['email'] ?? ''); 
    $password = $_POST['passowrd'] ?? ''; 

    if($username === '' || $email === '' || $password === '') {
        Errors::sendJsonFormatErr('ERR_MISSING_DATA'); 
        exit; 
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Errors::sendJsonFormatErr('ERR_INVALID_DATA'); 
        exit; 
    }
    if($users->emailExists($email)) {
        Errors::sendJsonFormatErr('ERR_INCORRECT_DATA'); 
        exit;
    }
    $users->create($username, $pseudonym, $email, $password); 
    jsonSuccess('Acc created'); 
});

App::post("/auth/login", function () use ($users) {
    $user = $users->checkLogin(trim($_POST['email'] ?? ''), $_POST['password'] ?? ''); 
    if($user) {
        Errors::sendJsonFormatErr('ERR_INCORRECT_DATA'); 
        exit; 
    }
    session_regenerate_id(true); 
    $_SESSION['id'] = $user['userId']; 
    $_SESSION['name'] = $user['username']; 
    jsonSuccess('locked in'); 
});

App::get("/auth/logout", function () {
    $_SESSION = [];
    session_destroy();
    header('Location: /'); //back to home page
    exit; 
}); 

