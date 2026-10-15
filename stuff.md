# YAAAARRRR 

## AI HELP AND SUGGESTIONS 

### AI EDUCATING ME TYPE SHIR 
#### INTERACTIVE STUFFIES 

User clicks the 'Save' button. The click handler 
catches the event and serializes the form input fields into a JavaScript object.
``` js 
$('#save-form').on('submit', function(e) {
  e.preventDefault();
  const payload = $(this).serialize();
  sendAjax(payload);
}); 
```
--- 

jQuery constructs an asynchronous 
XMLHttpRequest (XHR) HTTP POST request with form 
data and dispatches it in the background without refreshing the page.
``` js 
$.ajax({
  type: 'POST',
  url: '/api/save.php',
  data: { name: 'Alex', email: 'alex@dev.co' },
  dataType: 'json'
});
```
----

PHP server receives the POST data, sanitizes inputs, 
opens a PDO database connection, and executes a prepared SQL INSERT statement.
``` js 
<?php
// save.php
$stmt = $pdo->prepare('INSERT INTO users (name, email) VALUES (?, ?)');
$stmt->execute([$_POST['name'], $_POST['email']]);
?>
```
----

Database engine completes transaction, 
writes record to storage disk, and returns 
a success status with the newly created row primary ID.
``` sql
/* MySQL Engine Result */
Status: Query OK, 1 row affected (0.001 sec)
Last Insert ID: 1042
State: TRANSACTION_COMMITTED
```
---

PHP script encodes the status array into JSON format 
and writes HTTP headers with 200 OK status code back to the client.
``` js 
header('Content-Type: application/json');
echo json_encode([
  'status' => 'success',
  'id' => 1042,
  'message' => 'Record saved'
]);
```
---
jQuery AJAX .done() promise callback receives 
the JSON response and updates DOM elements smoothly to display success confirmation.
``` js 
.done(function(res) {
  if (res.status === 'success') {
    $('#status-msg').text(res.message).addClass('show');
  }
});
```

--- 
###### 0: UNSENT 
The XMLHttpRequest instance is created and 
configured via $.ajax(). Request headers and parameters are defined.
``` js 
xhr.open('GET', '/api/users.php', true);
```

Server is idle on TCP socket. No network packets have left the client engine yet.
`// PHP process listening on port 80/443`

No connection established. Socket buffer empty.
`TCP: UNINITIALIZED`

###### 1: OPENED 
xhr.open() has executed successfully. 
Browser sets target URL, HTTP method, 
and initiates TCP 3-way handshake.
``` js 
xhr.setRequestHeader('Accept', 'application/json');
xhr.send();
```

Web server (Nginx/Apache) accepts client TCP connection and assigns socket descriptor.
` 127.0.0.1 - - [GET /api/users.php HTTP/1.1] 101 `

TCP Handshake [SYN, SYN-ACK, ACK] complete. HTTP request headers transmitted over socket.
` TCP: CONNECTED (Port 443) `

---
###### 2: HEADERS 
xhr.send() complete. Client receives response HTTP 
headers and status code (200 OK) from the server.
``` js 
xhr.status === 200 // OK
xhr.getResponseHeader('Content-Type');
```

PHP-FPM spawns worker thread, evaluates script, and outputs HTTP response headers with Content-Type JSON.
`header('Content-Type: application/json');`
`http_response_code(200);`

HTTP 200 OK headers received. Content-Type and Transfer-Encoding parsed by browser.
`HTTP/1.1 200 OK`
`Content-Type: application/json`
----

###### 3: LOADING 
Downloading response body stream. xhr.responseText contains partial JSON payload chunks as they arrive.
``` js 
// Receiving stream chunks...
console.log(xhr.responseText.length);
```

PHP script queries SQLite database `SELECT * FROM users`, converts dataset to JSON array, and flushes output buffer.
``` php
$db = new SQLite3('app.db');
$res = $db->query('SELECT * FROM users');
echo json_encode($res->fetchAll());
```

TCP packets transporting JSON payload string across socket buffer.
`PAYLOAD STREAM: {"status":"ok","data":[...]}`

---

###### 4: DONE 
Transmission complete. jQuery receives full JSON payload, executes success callback, and updates DOM UI elements.
``` js 
$.ajax({ success: function(data) {
  $('#user-list').html(render(data));
}})
```

PHP script execution completes, closes SQLite connection, and returns PHP-FPM worker back to pool.
`fastcgi_finish_request(); // Worker freed`

All HTTP payload bytes delivered. TCP connection closed or returned to Keep-Alive pool.
` TRANSFER COMPLETE (2.4 KB, 14ms) `


### EXAMPLE STARTER CODE 

###### PHP VIEW 
This file contains the HTML structure. 
It loads the jQuery library from a CDN and links to your custom JavaScript file.
``` php 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AJAX Note Saver</title>
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

    <h2>Leave a Note</h2>
    
    <form id="noteForm">
        <input type="text" id="username" name="username" placeholder="Your name" required>
        <input type="text" id="message" name="message" placeholder="Your message" required>
        <button type="submit">Save Note</button>
    </form>

    <!-- This is where jQuery will inject the success or error message -->
    <div id="responseMessage" style="margin-top: 15px; font-weight: bold;"></div>

    <!-- Load your custom script -->
    <script src="script.js"></script>

</body>
</html>
```

###### PHP BACKEND 
This script receives the POST request from jQuery, 
connects to the SQLite database using PHP Data Objects (PDO), 
saves the data, and echoes a JSON response.

``` php
<?php
// Set headers so the browser knows we are sending JSON data back
header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

// Grab the POST data sent by jQuery
$username = $_POST['username'] ?? '';
$message = $_POST['message'] ?? '';

if (empty($username) || empty($message)) {
    echo json_encode(['status' => 'error', 'message' => 'Both fields are required.']);
    exit;
}

try {
    // 1. Connect to SQLite (it will create 'database.sqlite' if it doesn't exist)
    $pdo = new PDO('sqlite:database.sqlite');
    
    // Set error mode to throw exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Create the table if this is the first time running the script
    $pdo->exec("CREATE TABLE IF NOT EXISTS notes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        message TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 3. Prepare the SQL statement (protects against SQL injection)
    $stmt = $pdo->prepare("INSERT INTO notes (username, message) VALUES (:username, :message)");
    
    // 4. Execute the statement with our data
    $stmt->execute([
        ':username' => $username,
        ':message' => $message
    ]);

    // 5. Send a success response back to jQuery
    echo json_encode(['status' => 'success', 'message' => 'Note saved successfully!']);

} catch (PDOException $e) {
    // Send an error response back to jQuery if the database fails
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
```

###### JQUERY & JAVASCRIPT 
This script listens for the form submission, 
stops the page from reloading, and sends the data to the server in the background.
``` js 
$(document).ready(function() {
    
    $('#noteForm').on('submit', function(e) {
        // Stop the browser from reloading the page
        e.preventDefault(); 
        
        // Grab the data from the input fields
        const formData = {
            username: $('#username').val(),
            message: $('#message').val()
        };

        // Send the background AJAX request
        $.ajax({
            url: 'api.php',
            type: 'POST',
            data: formData,
            dataType: 'json', // We expect PHP to return JSON
            
            success: function(response) {
                // This runs if the server responds without crashing
                if (response.status === 'success') {
                    $('#responseMessage').css('color', 'green').text(response.message);
                    $('#noteForm')[0].reset(); // Clear the form
                } else {
                    $('#responseMessage').css('color', 'red').text(response.message);
                }
            },
            
            error: function() {
                // This runs if the PHP file isn't found or the server crashes
                $('#responseMessage').css('color', 'red').text('Server communication failed.');
            }
        });
    });

});
```

To test this, run `php -S localhost:8000` in your terminal from inside that folder, 
then open http://localhost:8000/index.php in your browser.

### PHP 

### JAVASCRIPT 

### JQUERY 



## ABANDONED / REPLACED / PREVIOUS CODE 

## STOLEN CODE FROM OTHER PLACES 
connect stuff stolen from GA 
``` php

$db = './databas/database.sqlite';
$dsn = "sqlite:$db";

try { 
    $pdo = new \PDO($dsn);
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS cattos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT,
            breed TEXT,
            img TEXT
        );
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT,
            email TEXT,
            hashedPassword VARCHAR(255)
        );
    ");
    //echo "gay successfully";
} catch (\PDOException $e) {
    echo "". $e->getMessage() ."";
}
```

helpers example from GA 
``` php
<?php

const PATH_PREFIX = "/GA/";
const BASE_URL = "http://localhost".PATH_PREFIX;

function redirect($path) {
    header("Location: " . BASE_URL . $path);
    exit;
}

function loginRequired() {
    if(!isset($_SESSION["id"])){
        redirect("auth/login");
    }
}

//optional, could put !loginRequired, not sure tho, have to test it 
function loginNotRequired() {
    if(isset($_SESSION["id"])){
        redirect("cats");
    }
}

const ERRORS = [
    'ERR_MISSING_DATA' => ['status'=>400, 'message'=>'ERR: The data is meowssing.'],
    'ERR_INVALID_DATA' => ['status'=>400, 'message'=>'ERR: The data is invalid.'],
    'ERR_LOCKED_OUT'=>['status'=>401, 'message'=>'ERR: Log in first dude..'],
    'ERR_INCORRECT_DATA'=>['status'=>401, 'message'=>'ERR: Incorrect data.'],
    'ERR_FORBIDDEN'=>['status'=>403, 'message'=>'ERR: The audacity you meowtherfucker.. ts is furbidden for u.'],
    'ERR_NOT_FOUND'=>['status'=>404, 'message'=>'ERR: The requested resource is meowssing.. gone..'],
    'ERR_UPLOAD_FAIL'=>['status'=>422, 'message'=>'ERR: the file upload failed, sorri bum']
];

function sendErrorPath($errorCode){

    http_response_code(ERRORS[$errorCode]['status']);
    echo json_encode([
        'errorPath' => PATH_PREFIX.'errors/'.$errorCode
    ]);

}
```

index.php from GA LOL 
``` php 
<?php

require_once 'router.php';
require_once 'src/Response.php';
require_once 'src/connect.php';
require_once 'src/funHelper.php';
global $pdo;

session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Lax']);

//TODO DEFINE THEM COOKIES MAN :(

// MAKE IT COOL LATER
//TODO fix design and such in css.
//TODO fix media query for bigger screens, work in mobile first from now on.

//TODO finish writing documentation
//TODO review and edit documentation

$navItems = [
    ['id' => 'home', 'text' => 'Home', 'url' => PATH_PREFIX],
    ['id' => 'cars', 'text' => 'Cats', 'url' => PATH_PREFIX."cats"],
    ['id' => 'contact', 'text' => 'Contact', 'url' => PATH_PREFIX."cats/contact"],
];

$isLoggedIn = isset($_SESSION['id']);
$userName = $isLoggedIn ? $_SESSION['name'] : null; //if logged in is true --> username, otherwise --> null
$userId = $isLoggedIn ? $_SESSION['id'] : null;

require __DIR__ . "/vendor/autoload.php";
$renderer = new \Phug\Renderer([
    'paths' => [__DIR__ . '/views'],
    'expressionLanguage' => 'php'
]);
global $renderer;
$renderer->share('navItems', $navItems);
$renderer->share(['isLoggedIn' => $isLoggedIn, 'userName' => $userName, 'userId' => $userId, 'pathPrefix' => PATH_PREFIX, 'errors' => ERRORS]);

//HOME ROUTE
get("/", function () use ($renderer) {
    echo $renderer->renderFile('/homepage.pug', ['currentPage' => 'home']);
});

get("/cats/contact", function () use ($renderer) {
    echo $renderer->renderFile('/contact.pug', ['currentPage' => 'contact']);
});

get("/auth/register", function () use ($renderer) {
    echo $renderer->renderFile('/register.pug');
});

post("/auth/register", function () use ($pdo){

    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $requested = [
        "username"=>$_POST['username'],
        "email" => $_POST['email'],
        "hashedPassword" => $hashedPassword
    ];

    $checksql = "SELECT * FROM users WHERE email = :email";
    $checkStmt = $pdo->prepare($checksql);
    $checkStmt->execute(['email' => $requested['email']]);

    $emailExists = $checkStmt->fetchColumn()>0;

    if($emailExists){
        redirect("errors/ERR_INCORRECT_DATA");
    }

    $sql = "INSERT INTO users (name, email, hashedPassword) VALUES ( :username, :email, :hashedPassword)";
    $pdo->prepare($sql)->execute($requested);

    redirect("auth/login");

});

//LOGN ROUTE
get("/auth/login", function () use ($renderer) {
    echo $renderer->renderFile('/login.pug');
});

post("/auth/login", function() use ($pdo) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['hashedPassword'])){
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        redirect("cats");

    } else {
        redirect("errors/ERR_INCORRECT_DATA");
    }
});

//LOGOUT
get("/auth/logout", function () use ($renderer) {
    //(!loginRequired()); 
    // eller loginNotRequired, om jag lägger till denna funktionen, vet inte hur det funkar med övre eller OM det funkar 
    loginRequired();
    $_SESSION = [];

    session_destroy();
    redirect("cats");
});

get("/profile", function () use ($renderer, $pdo, $userId) {
    loginRequired();

    $stmt = $pdo->prepare("SELECT * FROM cattos WHERE postedById = :postedById");
    $stmt->execute(['postedById' => $userId]);

    $userCats = [];
    while($cat = $stmt->fetch(PDO::FETCH_ASSOC)){
        $userCats[] = [
            'id' => $cat['id'],
            'name' => $cat['name'],
            'breed' => $cat['breed'],
            'img' => PATH_PREFIX.$cat['img']
        ];
    }

    echo $renderer->renderFile('/profile.pug', ['cats' => $userCats]);
});


// NEW
delete("/deleteProfile", function () use ($renderer, $pdo) {
    loginRequired();
    parse_str(file_get_contents("php://input"), $_DELETE);
    $uId = $_SESSION['id'];

    $stmt = $pdo->query("SELECT img FROM cattos WHERE postedById = ?");
    $stmt->execute([$uId]);
    $Img = $stmt->fetchColumn();

    unlink(__DIR__."/".$Img);
    $pdo->prepare("DELETE FROM cattos WHERE postedById=?")->execute([$uId]);

    $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$uId]);

    $_SESSION = [];
    session_destroy();

    http_response_code(200);
    echo json_encode([
        'success' => true,
        'Loco'=> PATH_PREFIX.'cats'
    ]);

    //HA INTE REDIRECT FÖR DU FÅR VÄRSTA LOOPEN BRUV
});

patch("/profile", function() use($pdo){
    loginRequired();
    parse_str(file_get_contents('php://input'), $_PATCH);
    $uId = $_SESSION['id'];
    $givenPassword = $_PATCH['password'] ?? '';

    $stmt = $pdo->prepare("SELECT hashedPassword FROM users WHERE id=:id");
    $stmt->execute(['id' => $uId]);
    $user = $stmt->fetch();

    if(!$user || !password_verify($givenPassword, $user['hashedPassword'])){
        sendErrorPath('ERR_INCORRECT_DATA');
        return;
    }

    $allowedFields = ['name', 'email'];
    $updates = [];
    $params = [];

    foreach($allowedFields as $field){
        if(!empty($_PATCH[$field])){
            $updates[] = "$field = :$field";
            $params[$field] = $_PATCH[$field];
        }
    }

    if(!empty($updates)){
        $sql = "UPDATE users SET " . implode(', ', $updates) . " WHERE id = :id";

        $params['id'] = $uId;
        $stmt = $pdo->prepare($sql);

        if(!$stmt->execute($params)){
            $refreshStmt = $pdo->prepare("SELECT name, email FROM users WHERE id=:id");
            $refreshStmt->execute(['id' => $uId]);
            $updatedUser = $refreshStmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['name'] = $updatedUser['name'];
            $_SESSION['email'] = $updatedUser['email'];
        }
    }

    http_response_code(200);
    echo json_encode([
        'success' => true,
        'Loco'=> PATH_PREFIX.'cats'
    ]);
});

// SHOW ALL POSTS
get("/cats", function() use ($renderer, $pdo) {

    $stmt = $pdo->query("SELECT id, name, breed, img, postedById FROM cattos");
    $cats = [];
    while ($cat = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $cats[] = [
            'id' => $cat['id'],
            'name' => $cat['name'],
            'breed' => $cat['breed'],
            'img' => PATH_PREFIX.$cat['img'],
            'postedById' => $cat['postedById']
        ];
    };

    echo $renderer->renderFile('/cats.pug', [
         'cats'=>$cats,
         'currentPage' => 'cars'
    ]);
});

//CREATE ROUTE
get("/cats/create", function () use ($renderer){
    loginRequired();
    echo $renderer->renderFile('/create.pug', ['currentPage' => 'createCar']);
});

post("/cats", function () use ($pdo, $userId){
    loginRequired();
    if(!isset($_FILES['img']) || $_FILES['img']['error'] != UPLOAD_ERR_OK) { //error fältet har inge, om allt är okej yes
        redirect("errors/ERR_UPLOAD_FAIL");
    }

    $allowedExes = ['png', 'jpg', 'jpeg', 'gif', 'webp'];
    $fileName = $_FILES['img']['name'];
    $tmpName = $_FILES['img']['tmp_name'];
    $fileEx = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); //make it lowercase

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $tmpName);
    finfo_close($finfo);

    $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    if(!in_array($mimeType, $allowedMimes)) {
        redirect("errors/ERR_INVALID_DATA");
    }

    if(!in_array($fileEx, $allowedExes)) {
        redirect("errors/ERR_INVALID_DATA");
    }

    $uniqueFileName = "posts/".uniqid('cat_').".".$fileEx;

    if(!move_uploaded_file($_FILES['img']['tmp_name'], (__DIR__."/".$uniqueFileName))) {
        redirect("errors/ERR_UPLOAD_FAIL");
    }

    $requested = [
        "name"=>$_POST['name'],
        "breed" => $_POST['breed'],
        "img" => $uniqueFileName,
        "postedById" => $userId
    ];
    $sql = "INSERT INTO cattos (name, breed, img, postedById) VALUES ( :name, :breed, :img, :postedById)";
    $pdo->prepare($sql)->execute($requested);

    redirect("cats");
});


// ONE PRODUCT VIEW
get('/cats/$id', function($id) use ($renderer, $pdo, $userId){
    $stmt = $pdo->prepare("SELECT * FROM cattos WHERE id=:id");
    $stmt->execute(['id' => $id]);
    $catPost = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$catPost){
        sendErrorPath('ERR_NOT_FOUND');
        return;
    }

    $isOwner = false;
    if($catPost['postedById'] == $userId){
        $isOwner = true;
    }

    echo $renderer->renderFile('/cat.pug', ['catPost' => $catPost, 'isOwner' => $isOwner, 'userId' => $userId]);
});


// DELETE THING
delete("/cats", function () use ($pdo) {
    loginRequired();
    parse_str(file_get_contents("php://input"), $_DELETE);
    $catId = $_DELETE['id'];

    $stmt = $pdo->query("SELECT img FROM cattos WHERE id = :id");
    $stmt->execute(['id' => $catId]);
    $img = $stmt->fetchColumn();

    unlink(__DIR__."/".$img);
    $pdo->prepare("DELETE FROM cattos WHERE id=?")->execute([$catId]);

    //HA INTE REDIRECT FÖR DU FÅR VÄRSTA LOOPEN BRUV
});


// UPDATE ROUTES
patch("/cats", function () use($pdo, $userId) {
    loginRequired();
    parse_str(file_get_contents('php://input'), $_PATCH);
    $request = ["id" => $_PATCH['id'] ?? null, "name" => $_PATCH['name'] ?? null, "breed" => $_PATCH['breed'] ?? null];

    $sqlPramValues = array_filter($request, function ($value) {
        return !empty($value);
    });

    if(count($sqlPramValues) > 1 && isset($sqlPramValues['id'])) {
        $sql = "UPDATE cattos SET ";
        $setClauses = []; // clause is name = "luffy" can be called columnsToChange

        foreach($sqlPramValues as $field => $value) {
            if($field=='id') continue;
            $setClauses[] = "$field = :$field";
        }

        $sql .= implode(', ', $setClauses);
        $sql .= " WHERE id = :id AND postedById = :postedById";

        $sqlPramValues['postedById'] = $userId;

        $stmt = $pdo->prepare($sql);
        $stmt->execute($sqlPramValues);

        if($stmt->rowCount() === 0){
            sendErrorPath('ERR_FORBIDDEN');
            return;
        }
    }

    header("Loco: /cats"); //GÖR PROLLY INGENTING!!!!
    echo "sauces";
});

post("/cats/image", function() use($pdo, $userId){
    loginRequired();
    $id = $_POST['id'] ?? null;
    $carFile = $_FILES['img'] ?? null;

    if(!$id || !$carFile || $carFile['error'] !== UPLOAD_ERR_OK) {
        sendErrorPath('ERR_MISSING_DATA');
        return;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $carFile['tmp_name']);
    finfo_close($finfo);

    $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    if(!in_array($mimeType, $allowedMimes)) {
        sendErrorPath('ERR_INVALID_DATA');
        return;
    }

    $ext = strtolower(pathinfo($carFile['name'], PATHINFO_EXTENSION));
    if(!in_array($ext, ['png', 'jpg', 'jpeg', 'gif', 'webp'])) {
        sendErrorPath('ERR_INVALID_DATA');
        return;
    }

    try {
        $stmt = $pdo->prepare("SELECT img FROM cattos WHERE id = ? AND postedById = ?");
        $stmt->execute([$id, $userId]);
        $oldCarImg = $stmt->fetchColumn();

        if(!$oldCarImg){
            sendErrorPath('ERR_MISSING_DATA');
            return;
        }

        $newImgPath = "posts/".uniqid('cat_').".".$ext;
        if(!move_uploaded_file($carFile['tmp_name'], __DIR__."/".$newImgPath)) {
            sendErrorPath('ERR_UPLOAD_FAIL');
            return;
        }

        $updateStmt = $pdo->prepare("UPDATE cattos SET img = ? WHERE id = ? AND postedById = ?");
        $updateStmt->execute([$newImgPath, $id, $userId]);

        if(!empty($oldCarImg) && file_exists(__DIR__."/".$oldCarImg)) {
            unlink(__DIR__."/".$oldCarImg);
        }

        json_encode(['status'=>'sauce', 'message'=>'picture uploaded saucely']);

    } catch (PDOException $e) {
        sendErrorPath('ERR_UPLOAD_FAIL');
    }

});

get('/errors/$errorCode', function($errorCode) use($renderer){
    echo $renderer->renderFile('/errors.pug', ['errorCode' => $errorCode]);
});
```



``` js
$(document).ready(function () {
    $("#createForm").on('submit', function (e) {
        e.preventDefault();

        const formData = {
            title: $('#title').val(),
            atype: $('#atype').val(),
            published: $('#published').val(),
            rating: $('#rating').val()
        };

        $.ajax({
            url: '/animes', // Fixed: Point to the router endpoint, not index.php
            type: 'POST',
            contentType: 'application/json', // Fixed: Tell the server we are sending JSON
            data: JSON.stringify(formData),  // Fixed: Convert object to JSON string
            dataType: 'json',

            success: function (response) {
                if (response.status === 'success') {
                    $('#responseMessage').css('color', 'purple').text(response.message);
                    $('#createForm')[0].reset();
                } else {
                    $('#responseMessage').css('color', 'red').text(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Tip: logging xhr.responseText helps debug server errors
                console.error(xhr.responseText);
                $('#responseMessage').css('color', 'red').text('Server Communication fail.');
            }
        });
    });
});
```


``` php
App::post("/animes", function () use ($pdo) {
    header('Content-Type: application/json');
    
    // Read the incoming JSON payload
    $newAnime = json_decode(file_get_contents('php://input'), true);

    $req = [
        "title" => $newAnime['title'] ?? '',
        "atype" => $newAnime['atype'] ?? '',
        "published" => isset($newAnime['published']) ? (int) $newAnime['published'] : 0,
        "rating" => isset($newAnime['rating']) ? (int) $newAnime['rating'] : 0,
        "createdById" => 1
    ];

    // 1. Validate
    if (empty($req['title']) || empty($req['atype']) || empty($req['published']) || empty($req['rating'])) {
        http_response_code(400); // Bad Request
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid or missing data'
        ]);
        exit; // Stop execution here
    } 

    // 2. Insert into Database
    try {
        $sql = "INSERT INTO animes (title, atype, published, rating, createdById) VALUES (:title, :atype, :published, :rating, :createdById);";
        $pdo->prepare($sql)->execute($req);
        
        // 3. Send Success Response
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'message' => 'Success!!!!'
        ]);
        exit; // Stop execution. Do NOT use Res::redirect() on AJAX endpoints.

    } catch (Exception $e) {
        // Handle potential database errors
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error'
        ]);
        exit;
    }
});
```



``` php
class Errors {
    const ERRORS = [
        'ERR_MISSING_DATA' => ['status'=>400, 'message'=>'ERR: Data is missing'],
        'ERR_INVALID_DATA'=> ['status'=>400, 'message'=>'ERR: Invalid data'],
        'ERR_LOCKED_OUT'=>['status'=>401, 'message'=>'ERR: Not authorized'],
        'ERR_INCORRECT_DATA'=>['status'=>401, 'message'=>'ERR_ Incorrect data'],
        'ERR_FORBIDDEN' => ['status'=>403, 'message'=>'ERR: Forbidden'], 
        'ERR_NOT_FOUND'=>['status'=>404, 'message'=>'ERR: Requested resource missing'],
        'ERR_UPLOAD_FAIL'=>['status'=>422, 'message'=>'ERR: Upload fail']
    ]; 

    // Add this new method for your AJAX calls
    public static function sendJsonErr($errorCode) {
        $error = self::ERRORS[$errorCode];
        http_response_code($error['status']); 
        echo json_encode([
            'status' => 'error',
            'message' => $error['message']
        ]); 
    }

    public static function sendErrPath($errorCode){
        http_response_code(self::ERRORS[$errorCode]['status']); 
        echo json_encode([
            'errorPath' => PATH_PREFIX . 'errors/' . $errorCode
        ]); 
    }
}
```


``` php 
App::post("/animes", function () use ($pdo) {
    header('Content-Type: application/json');
    $newAnime = json_decode(file_get_contents('php://input'), true);

    $req = [
        "title" => $newAnime['title'] ?? '',
        "atype" => $newAnime['atype'] ?? '',
        "published" => isset($newAnime['published']) ? (int) $newAnime['published'] : 0,
        "rating" => isset($newAnime['rating']) ? (int) $newAnime['rating'] : 0,
        "createdById" => 1
    ];

    // Use your Errors class here!
    if (empty($req['title']) || empty($req['atype']) || empty($req['published']) || empty($req['rating'])) {
        Errors::sendJsonErr('ERR_INVALID_DATA'); 
        exit; // Always exit after sending a response
    } 

    try {
        $sql = "INSERT INTO animes (title, atype, published, rating, createdById) VALUES (:title, :atype, :published, :rating, :createdById);";
        $pdo->prepare($sql)->execute($req);
        
        http_response_code(200);
        echo json_encode([
            'status'=>'success',
            'message'=>'Success!!!!'
        ]);
        exit;

    } catch (Exception $e) {
        // You could also create an 'ERR_SERVER_FAIL' in your class and call it here
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Database error']);
        exit;
    }
});
```

``` js
$.ajax({
            url: '/animes',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            dataType: 'json',

            success: function (response) {
                // This runs on 200 HTTP codes
                if (response.status === 'success') {
                    $('#responseMessage').css('color', 'purple').text(response.message);
                    $('#createForm')[0].reset();
                }
            },
            error: function (xhr) {
                // This runs on 400+ HTTP codes triggered by Errors::sendJsonErr
                let errorMessage = 'Server Communication fail.';
                
                if (xhr.responseText) {
                    try {
                        const errData = JSON.parse(xhr.responseText);
                        errorMessage = errData.message; // Grabs the message from your PHP array
                    } catch(e) {
                        console.error("Could not parse error response");
                    }
                }
                
                $('#responseMessage').css('color', 'red').text(errorMessage);
            }
        }); 
```



``` php
App::get("/animes", function () use($pdo) {
    $stmt = $pdo->query("SELECT id, title, atype, published, rating, createdById FROM animes"); 
    $animes = []; 
    while ($anime = $stmt->fetch(PDO::FETCH_ASSOC)){
        $animes[] = [
            'id' => $anime['id'],
            'title' => $anime['title'],
            'atype' => $anime['atype'],
            'published' => $anime['published'],
            'rating' => $anime['rating'], 
            'createdById' => $anime['createdById']
        ];
    } 

    // Include the view so it can use the $animes array
    include('view.php');
});
```

``` php
<div class="aPodium" id="aPod">
            <?php if (!empty($animes)): ?>
                
                <?php foreach ($animes as $anime): ?>
                    <div class="anime-card" style="border: 1px solid #ccc; margin-bottom: 10px; padding: 10px;">
                        <!-- htmlspecialchars prevents XSS attacks if users type malicious code into the form -->
                        <h3><?= htmlspecialchars($anime['title']) ?></h3>
                        <p><strong>Type:</strong> <?= htmlspecialchars($anime['atype']) ?></p>
                        <p><strong>Published:</strong> <?= htmlspecialchars($anime['published']) ?></p>
                        <p><strong>Rating:</strong> <?= htmlspecialchars($anime['rating']) ?>/10</p>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <p>No animes found. Be the first to create one!</p>
            <?php endif; ?>
        </div>
```


``` php
echo json_encode(['status' => 'success', 'redirectUrl' => '/animes']);
```

``` js
success: function (response) {
    if (response.status === 'success') {
        // Let the frontend handle the navigation
        window.location.href = response.redirectUrl; 
    }
}
```



## ABANDONED CODE 
``` php 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLINGO</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1></h1>
        <nav>
            <a href="">HOME</a>
            <a href="">POEMS</a>
            <a href="">PROFILE</a>
        </nav>
    </header>

    <main>
        <h4>POST A POEM, PLING-EM ALL!</h4>
        <div class="createFormDiv" id="createFormDiv">
            <form action="" id="createForm">
                <input type="text" id="title" name="title" placeholder="Title" required>
                <input type="text" id="genre" name="genre" placeholder="Genre" required>
                <input type="text" id="poem" name="poem" placeholder="Paste poem here!" required>
                <label for="pImg">Add a picture for the vibes!</label>
                <input type="file" name="pImg" id="pImg">
                <button type="submit">CREATE</button>
            </form>

        </div>

        <div id="responseMessage" style="border:2px solid purple;">
            <!-- response message will show here  -->
        </div>

        <div class="aPodium" id="aPod">
            <?php if (!empty($animes)): ?>
                <?php foreach ($animes as $anime): ?>
                    <div class="anime-card">
                        <div class="animeImg">
                            <img src="/posts/<?= $anime['animeImg'] ?>" alt="animeImg">
                        </div>
                        <h3><?= htmlspecialchars($anime['title']) ?></h3>
                        <p>Type:<?= htmlspecialchars($anime['atype']) ?></p>
                        <p>Published: <?= htmlspecialchars($anime['published']) ?> </p>
                        <p>Rating: <?= htmlspecialchars($anime['rating']) ?> /10</p>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <p>Add an anime youve watched.</p>
            <?php endif; ?>
        </div>

    </main>

    <footer>

    </footer>

    <script src="cold.js"></script>

</body>

</html> 
```

``` js 
$(document).ready(function () {
    $("#createForm").on('submit', function (e) {
        e.preventDefault();

        const formData = {
            title: $('#title').val(),
            atype: $('#atype').val(),
            published: $('#published').val(),
            rating: $('#rating').val(),
            animeImg: $('#animeImg').val()
        }

        $.ajax({
            url: '/animes',
            type: 'POST',
            contentType: 'applicaiton/json',
            data: JSON.stringify(formData),
            dataType: 'json',

            success: function (response) {
                if (response.status === 'success') {
                    $('#responseMessage').css('color', 'purple').text(response.message);
                    $('#createForm')[0].reset();
                } else {
                    $('#responseMessage').css('color', 'red').text(response.message);
                }
            },
            error: function (xhr) {
                let errorMessage = 'Server communication fail';
                if (xhr.responseText) {
                    try {
                        const errData = JSON.parse(xhr.responseText);
                        errorMessage = errData.message;
                    } catch (e) {
                        console.error('Couldnt parse response');
                    }
                }

                 $('#responseMessage').css('color', 'red').text(errorMessage)

                // console.error(xhr.responseText); 
                // $('#responseMessage').css('color', 'red').text('Server Communication fail.');
            }
        });
    });
});
```

``` php
<?php

require_once 'router.php';
require_once 'source/connect.php';
require_once 'source/helpers.php';
global $pdo;

App::get("/", function () {
    include('view.php');
});

App::get("/animes", function () use($pdo) {

    $stmt = $pdo->query("SELECT id, title, atype, published, rating, createdById FROM animes"); 
    $animes = []; 
    while ($anime = $stmt->fetch(PDO::FETCH_ASSOC)){
        $animes[] = [
            'id' => $anime['id'],
            'title'=>$anime['title'],
            'atype'=>$anime['atype'],
            'published'=>$anime['published'],
            'rating'=>$anime['rating'],
            'createdById'=>$anime['createdById']
        ];
    }

    include("view.php");
});

App::post("/animes", function () use ($pdo) {
    header('Content-Type: application/json');
    $newAnime = json_decode(file_get_contents('php://input'), true);

    if(!isset($_FILES['img']) || $_FILES['img']['error'] != UPLOAD_ERR_OK){
        echo json_encode(['status'=>'error', 'message'=>'youre gay']); 
    }

    $req = [
        "title" => $newAnime['title'] ?? '',
        "atype" => $newAnime['atype'] ?? '',
        "published" => (int) $newAnime['published'],
        "rating" => (int) $newAnime['rating'],
        "animeImg"=>PATHS::RESOURCES_PATH.$newAnime["animeImg"],
        "createdById" => (int) 1
    ];

    if (empty($req['title']) || empty($req['atype']) || empty($req['published']) || empty($req['rating'])) {
        Errors::sendJsonFormatErr('ERR_INVALID_DATA'); 
        exit; 
    } 

    try{
        $sql = "INSERT INTO animes (title, atype, published, rating, animeImg, createdById) VALUES (:title, :atype, :published, :rating, :img, :createdById);";
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

App::delete("/animes", function () {});

App::patch("/animes", function () {});

// Auth 

App::get("/auth", function () {});

App::post("/auth/register", function () {});

App::post("/auth/login", function () {});

App::get('/errors/$errorCode', function($errorCode){

});
```

``` php
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
            img TEXT,
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
    // echo "" . $e->getMessage() . ""; 
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}


```


``` php
App::get("/poems", function () use($pdo) {

    // 1. Use a JOIN to get poems and user data at the same time
    $sql = "
        SELECT 
            p.id, p.title, p.genre, p.poem, p.createdById, 
            u.pseudonym, u.username 
        FROM poems p
        LEFT JOIN users u ON p.createdById = u.id
    ";
    
    $stmt = $pdo->query($sql); 
    $poems = []; 
    
    // 2. The fetched row now contains the user data as well
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $poems[] = [
            'id'          => $row['id'],
            'title'       => $row['title'],
            'genre'       => $row['genre'],
            'poem'        => $row['poem'],
            'createdById' => $row['createdById'],
            // Now you have direct access to the user's info!
            'pseudonym'   => $row['pseudonym'],
            'username'    => $row['username']
        ];
    }

    include("view.php");





        $stmt = $pdo->query("SELECT id, title, genre, poem, createdById FROM poems"); 
    $poems = []; 
    while ($poem = $stmt->fetch(PDO::FETCH_ASSOC)){
        $poems[] = [
            'id' => $poem['id'],
            'title'=>$poem['title'],
            'atype'=>$poem['atype'],
            'published'=>$poem['published'],
            'rating'=>$poem['rating'],
            'createdById'=>$poem['createdById']
        ];
    }

    $stmt = $pdo->query("SELECT pseudonym, username FROM users WHERE id=?"); 
    $stmt->execute([$poem['createdById']]); 
    $creator = $stmt->fetchColumn(); 

    include("view.php");
});
```

``` php
<div class="aPodium" id="aPod">
            <?php if (!empty($poems)): ?>
                <?php foreach ($poems as $poem): ?>
                    <div class="poem-card">
                        <div class="pImg">
                            <!-- Make sure pImg is included in your SELECT statement and $poems array! -->
                            <img src="/posts/<?= $poem['pImg'] ?>" alt="pImg">
                        </div>
                        <h3><?= htmlspecialchars($poem['title']) ?></h3>
                        
                        <!-- NEW: Displaying the author's pseudonym (or username) -->
                        <p><strong>By:</strong> <?= htmlspecialchars($poem['pseudonym']) ?> (@<?= htmlspecialchars($poem['username']) ?>)</p>
                        
                        <p>Type: <?= htmlspecialchars($poem['genre']) ?></p>
                        <p>Poem: <?= nl2br(htmlspecialchars($poem['poem'])) ?></p> 
                        <p>Published: <?= htmlspecialchars($poem['published']) ?></p> 
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <p>No poems posted yet. Be the first!</p>
            <?php endif; ?>
        </div>
```



``` js 
$('#createForm').on('submit', function(e) {
    e.preventDefault(); // Stop the page from refreshing

    // This grabs the entire form, including the actual image file
    let formData = new FormData(this); 

    $.ajax({
        url: '/your-post-route', // Update this to your actual POST route
        type: 'POST',
        data: formData,
        contentType: false, // CRITICAL: Tell jQuery not to set a content type
        processData: false, // CRITICAL: Tell jQuery not to turn the data into a string
        success: function(response) {
            $('#responseMessage').html("Poem and image uploaded!");
        }
    });
});
```

``` php
App::post("/poems", function () use($pdo) {
    // 1. Grab text inputs from standard $_POST (because we used FormData)
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $poem = $_POST['poem'];
    
    // 2. Handle the image upload
    $imageName = "";
    if (isset($_FILES['pImg']) && $_FILES['pImg']['error'] === UPLOAD_ERR_OK) {
        // This gets just the clean filename, e.g., "sharkcat.jpg"
        $imageName = basename($_FILES['pImg']['name']); 
        
        // Move the physical file from the temporary server folder to your actual posts folder
        $tempPath = $_FILES['pImg']['tmp_name'];
        $destinationPath = __DIR__ . '/posts/' . $imageName; 
        move_uploaded_file($tempPath, $destinationPath);
    }

    // 3. Save to database using the clean $imageName
    $stmt = $pdo->prepare("INSERT INTO poems (title, genre, poem, pImg, createdById) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $genre, $poem, $imageName, $_SESSION['user_id']]); 
    // Note: ensure you are passing the correct user ID above!
});
```

``` php 
    header('Content-Type: application/json');
    $newPoem = json_decode(file_get_contents('php://input'), true);

    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $poem = $_POST['poem']; 

    $imgName = ''; 
    if(isset($_FILES['pImg']) || $_FILES['pImg']['error'] != UPLOAD_ERR_OK){
        $imgName = basename($_FILES['pImg']['name']); 
        $tempPath = $_FILES['pImg']['tmp_name'];
        $destPath = __DIR__ . '/posts/' . $imgName; 
        move_uploaded_file($tempPath, $destPath); 
    }


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
```


``` php
App::post("/poems", function () use($pdo) {
    // Tell the browser we are sending JSON back to the AJAX request
    header('Content-Type: application/json');

    try {
        // 1. Grab text inputs (using ?? to prevent undefined array key warnings)
        $title = $_POST['title'] ?? '';
        $genre = $_POST['genre'] ?? '';
        $poem = $_POST['poem'] ?? '';
        
        // Ensure you have a way to get the logged-in user's ID
        // (Make sure session_start() is called somewhere globally in your app)
        $createdById = $_SESSION['user_id'] ?? null; 

        // Basic validation
        if (empty($title) || empty($genre) || empty($poem)) {
            throw new Exception("Title, genre, and poem are required.");
        }
        if (!$createdById) {
            throw new Exception("You must be logged in to post.");
        }

        // 2. Handle the image upload
        $imageName = ""; // Default to empty string if no image is uploaded
        
        // Check if a file was actually sent and if it has no initial upload errors
        if (isset($_FILES['pImg']) && $_FILES['pImg']['error'] !== UPLOAD_ERR_NO_FILE) {
            
            // Check for actual server/upload errors (e.g., file too large)
            if ($_FILES['pImg']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception("File upload failed with error code: " . $_FILES['pImg']['error']);
            }

            // Sanitize the filename to prevent weird characters from breaking things
            $imageName = basename($_FILES['pImg']['name']); 
            $imageName = preg_replace("/[^a-zA-Z0-9.-]/", "_", $imageName); // Replaces spaces/weird chars with underscores

            $tempPath = $_FILES['pImg']['tmp_name'];
            $destinationPath = __DIR__ . '/posts/' . $imageName; 
            
            // Move the file and throw an error if it fails (e.g., folder permissions issue)
            if (!move_uploaded_file($tempPath, $destinationPath)) {
                throw new Exception("Failed to move the uploaded file to the posts folder.");
            }
        }

        // 3. Save to database 
        $stmt = $pdo->prepare("INSERT INTO poems (title, genre, poem, pImg, createdById) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $genre, $poem, $imageName, $createdById]); 

        // 4. Send success response back to cold.js
        echo json_encode([
            "success" => true,
            "message" => "Poem successfully plinged!"
        ]);

    } catch (Exception $e) {
        // Catch any errors thrown above, set a bad request status, and return the error message
        http_response_code(400); 
        echo json_encode([
            "success" => false,
            "message" => $e->getMessage()
        ]);
    }
});
```

``` js 
$.ajax({
    url: '/poems', 
    type: 'POST',
    data: formData,
    contentType: false, 
    processData: false, 
    success: function(response) {
        // This runs if the PHP try block finishes
        $('#responseMessage').css('color', 'green').html(response.message);
        $('#createForm')[0].reset(); // Clears the form inputs
    },
    error: function(xhr) {
        // This runs if the PHP catch block sends a 400 error
        let res = JSON.parse(xhr.responseText);
        $('#responseMessage').css('color', 'red').html("Error: " + res.message);
    }
});
```


``` php 
App::post("/poems", function () use ($pdo) {
    header('Content-Type: application/json');

    // 1. Check if the file uploaded successfully
    if (!isset($_FILES['pImg']) || $_FILES['pImg']['error'] != UPLOAD_ERR_OK) {
        Errors::sendJsonFormatErr('ERR_INVALID_DATA');
        exit;
    }

    $allowedExes = ['png', 'jpg', 'jpeg', 'gif', 'webp'];
    // 2. FIXED TYPO: Changed 'img' to 'pImg'
    $fileName = basename($_FILES['pImg']['name']);
    $tmpName = $_FILES['pImg']['tmp_name'];
    $fileEx = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); 

    // Validate MIME type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $tmpName);
    finfo_close($finfo);

    $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mimeType, $allowedMimes)) {
        Errors::sendJsonFormatErr('ERR_INVALID_DATA');
        exit;
    }

    // Validate Extension
    if (!in_array($fileEx, $allowedExes)) {
        Errors::sendJsonFormatErr('ERR_INVALID_DATA');
        exit;
    }

    // Move the file
    $uniqueFileName = 'posts/' . uniqid('pic_') . '.' . $fileEx;
    if (!move_uploaded_file($_FILES['pImg']['tmp_name'], (__DIR__ . "/" . $uniqueFileName))) {
        Errors::sendJsonFormatErr('ERR_UPLOAD_FAIL');
        exit;
    }

    // 3. FIXED: Grab text inputs from $_POST since the frontend sent FormData
    $req = [
        'title' => $_POST['title'],
        'genre' => $_POST['genre'],
        'poem' => $_POST['poem'],
        'pImg' => $uniqueFileName,
        'published' => date('Y/m/d H:i:s'), // Fixed minor typo in date format (H:i:s instead of H:m:s)
        'createdById' => 1
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
```