<!-- ssh-keygen -t rsa -b 4096 -C "panagiotis.d.kostakis@gmail.com" -->
<!-- vanilla.test the URL from valet -->

<?php
require_once('env.php');
require_once('mysqlconnect.php');

// Those 2 must be outside of the scope of if(....."submit") and we have 2 of them because ther are 2 error 
// 1) "Your email is already being used
// 2) "Your email is required!
$errorbool1 = false;
$errorbool2 = false;

// This code will be excuted when we press Submit
if (isset($_POST["submit"])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    // Here we excecute the querry so whatever we write into our form will go into database.
    // On valued insteasd of '$first_name' , '$last_name' , '$email' we use ? , ? , ? since on $statement->bind_param we use them
    $query = "INSERT INTO `users` (`first_name` , `last_name` , `email`) VALUES (? , ? , ?)";

    //Since we using migration.php file we have to use the METHOD multy_query($....) to our $con so we instead of $con->query($query); we have -->
    //Although like this we are not protected since someone can write code in out inputs and for example he can delete our table `users`.
    // $con->multi_query($query);

    //Here we using prepare / bind_param / excecute so we protect our inputs.
    //We start with prepare Method.
    $statement = $con->prepare($query);
    //Then with bind_param Method we use the "sss" since we want to sanitize 3 strings if we want to sanitize int we use i, d for float, d for blob.
    $statement->bind_param("sss", $first_name, $last_name, $email);



    // Lastly we excecute
    if ($statement->execute()) {
        // If it excecutes then we going to success.php
        header("Location: success.php");
        exit;
    } else if ($con->errno === 1062)
        $errorbool1 = true;
    else if ($con->errno === 3819)
        $errorbool2 = true;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>PHP Progress</title>
</head>

<body>
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

</body>

</html>