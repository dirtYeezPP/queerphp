<?php include('parts/header.php'); ?>

<main>

    <div class="userPostsDiv" id="userPostsDiv">
        <?php if (!empty($userPoems)): ?>
            <?php foreach ($userPoems as $uP): ?>

                <div class="userPost-card">

                    <div class="borgirMenuContainer">
                        <button type="button" class="dotsBtn" aria-label="Post actions">&hellip;</button>
                        <div class="poemButtonsDiv hidden">
                            <!-- <button type="button" class="editPostBtn">Edit Post</button> -->
                            <a href="/poems/edit?id=<?= $uP['id']?>" class="editPostBtn">Edit Post</a>
                            <button type="button" class="deletePostBtn" data-id="<?= $uP['id'] ?>" >Delete Post</button>
                        </div>
                    </div>

                    <div class="userPostImgDiv">
                        <img src="/<?= htmlspecialchars($uP['pImg'], '/') ?>" alt="poem pic">
                    </div>
                    <div class="userPoemTextDiv">
                        <h3><?= htmlspecialchars($uP['title']) ?></h3>
                        <p>Genre:<?= htmlspecialchars($uP['genre']) ?></p>
                        <p><?= nl2br(htmlspecialchars($uP['poem'])) ?></p>
                        <p>Published: <?= htmlspecialchars($uP['published']) ?> </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</main>


<?php include('parts/footer.php'); ?>