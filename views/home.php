<!-- views/poems.php -->
<?php include('parts/header.php'); ?>

<main>
    <div class="registerFormDiv hidden" id="registerFormDiv">
        <form action="" id="registerForm">
            <input type="text" name="username" id="username" placeholder="username">
            <input type="text" name="pseudonym" id="pseudonym" placeholder="pseudonym">
            <input type="text" name="email" id="email" placeholder="email">
            <input type="password" name="password" id="password" placeholder="password">
            <button type="submit">REGISTER</button>
        </form>
        <p>Already have an account?</p>
        <button id="toggleLoginVisibility">Click here</button>
    </div>

    <div class="loginFormDiv hidden" id="loginFormDiv">
        <form action="" id="loginForm">
            <input type="text" name="email" id="email" placeholder="email">
            <input type="text" name="password" id="password" placeholder="password">
            <button type="submit">LOGIN</button>
        </form>
    </div>

    <div id="responseMessage" style="border:2px solid purple;">
        <!-- response message will show here  -->
    </div>

</main>

<?php include('parts/footer.php'); ?>