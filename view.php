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

        <div class="podium" id="pPod">
            <?php if (!empty($poems)): ?>
                <?php foreach ($poems as $poem): ?>
                    <div class="poem-card">
                        <div class="pImg">
                            <img src="/posts/<?= $poem['pImg'] ?>" alt="pImg">
                        </div>
                        <h3><?= htmlspecialchars($poem['title']) ?></h3>
                        <p>Genre:<?= htmlspecialchars($poem['genre']) ?></p>
                        <p><?= htmlspecialchars($poem['poem']) ?> </p>
                        <p>Published: <?= htmlspecialchars($poem['published']) ?> </p>
                        <p><?= htmlspecialchars($poem['pseudonym']) ?></p>
                        <p>(@<?= htmlspecialchars($poem['username']) ?>)</p> 

                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <p>Post a poem of yours!</p>
            <?php endif; ?>
        </div>

    </main>

    <footer>

    </footer>

    <script src="cold.js"></script>

</body>

</html>