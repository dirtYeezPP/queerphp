<?php include('parts/header.php'); ?>

    <h4>POST A POEM, PLING-EM ALL!</h4>
    <div class="createFormDiv" id="createFormDiv">
        <form action="" id="createForm">
            <input type="text" id="title" name="title" placeholder="Title" required>
            <input type="text" id="genre" name="genre" placeholder="Genre" required>
            <textarea id="poem" name="poem" placeholder="Paste poem here!" required></textarea>
            <label for="pImg">Add a picture for the vibes!</label>
            <input type="file" name="pImg" id="pImg">
            <button type="submit">CREATE</button>
        </form>
    </div>

    <div class="podium" id="pPod">
        <?php if (!empty($poems)): ?>
            <?php foreach ($poems as $poem): ?>
                <div class="poem-card">
                    <div class="pImg">
                        <img src="<?= $poem['pImg'] ?>" alt="poem image">
                    </div>
                    <h3><?= htmlspecialchars($poem['title']) ?></h3>
                    <p>Genre:<?= htmlspecialchars($poem['genre']) ?></p>
                    <p><?= nl2br(htmlspecialchars($poem['poem'])) ?></p>
                    <p>Published: <?= htmlspecialchars($poem['published']) ?> </p>
                    <p><?= htmlspecialchars($poem['pseudonym']) ?></p>
                    <p>(@<?= htmlspecialchars($poem['username']) ?>)</p>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <p>Post a poem of yours!</p>
        <?php endif; ?>
    </div>


<?php include('parts/footer.php'); ?>