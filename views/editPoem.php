<?php include('parts/header.php'); ?>

<main>
    <h4>CHANGE INFORMATION</h4>
    <p><strong>Only fill in the fields you actually want to change. <br> Leave the rest blank. </strong></p>

    <div class="uneditedPostDiv">

    </div>

    <div class="editPoemFormDiv">
        <form action="" id="editForm">
            <input type="hidden" name="id" value="<?= $poem['id']?>">
            <input type="text" name="title" id="editTitleField" placeholder="<?= htmlspecialchars($poem['title']) ?>">
            <input type="text" name="genre" id="editGenreField" placeholder="<?= htmlspecialchars($poem['genre']) ?>" >
            <textarea name="poem" id="editPoemField"> </textarea>
            <label for="editImgField">New picture?</label>
            <input type="file" name="pImg" id="editImgField">
            <button type="submit">SUBMIT</button>
        </form>
    </div>

    <div id="responseMessage" style="border:2px solid purple;">
        <!-- response message will show here  -->
    </div>

</main>
    

<?php include('parts/footer.php'); ?>