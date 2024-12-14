<!-- Index is the central meeting point for all of our code!! -->
<?php
//We required that so we can use autoload from PHPUnit
require "vendor/autoload.php";
use RouterSpace\Routes;
use UserControllerSpace\UserController;
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
   
   
   
   <!-- This is so we can see at the bottom of the page the $_SERVER['REQUEST_METHOD'] && $_SERVER['REQUEST_URI'].
   <pre style="position: absolute; bottom :0; left: 5px;">
       Method : <?php
    // echo ($_SERVER['REQUEST_METHOD']);
    ?>
    <br><br>
    <?php print_r($router);?>
    <br>
    URI :<?php
    // echo UserController::class;
    //  echo ($_SERVER['REQUEST_URI']);
    ?>       
    </pre> -->
</body>
    </html>