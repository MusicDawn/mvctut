<div class="box">
    <!-- // Form -->
    <!-- // When we press Submit button we basicly create the Superglobal ($_POST in our case).The Superglobal did not exist until we click submit -->
    <form action="index.php" method="post">
        <div class="inputBox">
            <!-- In those inputs PHP will look for the attribute name=... the id=.. is for CSS -->
            <input type="text" id="first_name" name="first_name" required>
            <label for="first_name">First Name</label>
        </div>
        <div class="inputBox">
            <input type="text" id="last_name" name="last_name" required>
            <label for="last_name">Last Name</label>
        </div>
        <div class="inputBox">
            <input type="email" id="email" name="email">
            <label for="email">Email</label>
            <!-- Here the isset checks if the $error exists (check UserController.php) -->
            <?php if (isset($errorMsg)) echo '<div style = "color: red" >' . $errorMsg . '</div><br><br>' ?>
        </div>
        <div class="inputBox">
            <!-- Submit basicly will set this form into action -->
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
    <a href="list" class="myButton">Go to list</a>
    <a href="listfa" class="myButton">Go to list F.A.</a>
</div>