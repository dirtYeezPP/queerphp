<!-- views/partials/header.php -->
<?php 
if(session_status() == PHP_SESSION_NONE){
    session_start(); 
}

$isLoggedIn = isset($_SESSION['id']);
$username = $isLoggedIn ? $_SESSION['name'] : null;
$userId = $isLoggedIn ? $_SESSION['id'] : null; 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLINGO</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="/style.css"> <!-- Make sure paths are absolute -->
</head>

<body>
    <header>
        <nav>
            <button id="navBorgirMenuBtn">&equiv;</button>
            <div class="linksDiv hidden">
                <a href="/">HOME</a>
                <a href="/poems">POEMS</a>
                <?php if (isset($userId)): ?>
                    <a href="/logout">LOG OUT</a>
                    <a href="/me">PROFILE</a>
                <?php else: ?>
                    <button id="authVisibility">AUTHBTN</button>
                <?php endif; ?>
            </div>

            <div class="GreetingDiv">
                <?php if (isset($userId)): ?>
                    <h3>HELLO <?= htmlspecialchars($username) ?></h3>
                <?php else: ?>
                    <h3>Hello Stranger</h3>
                <?php endif; ?>
            </div>

        </nav>
    </header>