<?php include('parts/header.php'); ?>

<main class="errorPage">
    <h2><?= (int)$status ?></h2>
    <p><?= htmlspecialchars($message) ?></p>
    <a href="/">Back to home</a>
</main>



<?php include('parts/footer.php'); ?>