<!-- Index is the central meeting point for all of our code!! -->
<?php
//We required that so we can use autoload from PHPUnit
require "vendor/autoload.php";

use RouterSpace\Routes;

require_once('env.php');
require_once('mysqlconnect.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/index.css">
    <title>PHP Progress</title>
</head>

<body>
    <?php
    // Those are our Routes the logic is in routes/Routes.php
    $router = new Routes;
    $router->dispatch(); ?>

    <select id="bgcolorpick">
        <option value="white">White</option>
        <option value="blue">Blue</option>
        <option value="purple">Purple</option>
    </select>
    <button onclick="saveColor()">Save Color </button>

    <script>
        function saveColor() {
            //color basicly = the value of our options above
            let color = document.getElementById("bgcolorpick").value
            //locaStorage Prototype uses setItem method to set key/value pair in Application/Local Storage
            localStorage.setItem("bgcolor", color)
            //This line acually giving us the color from the key/value pair in Application/Local Storage
            document.body.style.backgroundColor = localStorage.getItem("bgcolor")
        }
    </script>

</body>

</html>