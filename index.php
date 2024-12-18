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
    <link rel="stylesheet" href="public/index.css">
    <title>PHP Progress</title>
</head>

<body>
    <?php
    // Those are our Routes the logic is in routes/Routes.php
    $router = new Routes;
    $router->dispatch();
    ?>
</body>
    </html>