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
        <h1>HELLO DEAR PLIN!</h1>
        <nav>
            <a href="">HOME</a>
            <a href="">HOME1</a>
            <a href="">HOME2</a>
        </nav>
    </header>

    <main>
        <h4>CREATE AN ANIME YOU PLING</h4>
        <div class="createFormDiv" id="createFormDiv">
            <form action="" id="createForm">
                <input type="text" id="title" name="title" placeholder="title" required>
                <input type="text" id="atype" name="atype" placeholder="movie or series?" required>
                <input type="text" id="published" name="published" placeholder="published when?" required>
                <input type="text" id="rating" name="rating" placeholder="your rating" required>
                <input type="file" name="animeImg" id="animeImg">
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