<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLINGO</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    
    <header>
        <h1>HELLO DEAR PLIN!</h1>
        <nav>
            <a href="">HOME</a>
            <a href="">HOME1</a>
            <a href="">HOME2</a>
        </nav>
    </header>

    <main>
        <h4>CREATE AN ANIME YOU PLING</h4>
        <div class="createForm">
            <input type="text" name="title" placeholder="title">
            <input type="text" name="type" placeholder="movie or series?">
            <input type="text" name="published" placeholder="published when?">
            <input type="text" name="rate" placeholder="your rating">
            <input type="submit" value="CREATE">
        </div>

        <div id="responseMessage" style="border:2px solid purple;">
            <!-- response or success message will show here  -->
        </div>
    </main>

    <footer>

    </footer>

    <script src="script.js"></script>

</body>
</html>