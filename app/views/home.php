<div class="box">
    <!-- // Form -->
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
            <?php if ($errorbool1) {
                echo '<div style = "color: red" >Your email is already being used!</div> <br> <br>';
            } else if ($errorbool2) {
                echo '<div style = "color: red" >Your email is required!</div> <br> <br>';
            }
            ?>
        </div>
        <div class="inputBox">
            <!-- Submit basicly will set this form into action -->
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
</div>