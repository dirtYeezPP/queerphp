<?php include('parts/header.php'); ?>

<main>
    <h4>CHANGE INFORMATION</h4>
    <p><bold>Only fill in the fields you actually want to change. <br> Leave the rest blank. </bold></p>

    <div class="uneditedPostDiv">
        
    </div>

    <div class="editPoemFormDiv">
        <form action="" id="editForm">
            <input type="text" name="title" id="editTitleField" placeholder="">
            <input type="text" name="genre" id="editGenreField" placeholder="">
            <textarea name="poem" id="editPoemField"> </textarea>
            <label for="editImgF">New picture?</label>
            <input type="file" name="pImg" id="editImgF">
            <button type="submit">SUBMIT</button>
        </form>
    </div>
</main>
    

<?php include('parts/footer.php'); ?>