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


