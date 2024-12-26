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
    // echo "<pre>";
    // echo "<br> The print_r(\$_GET); Give us : ";
    // print_r($_GET);
    // echo "<br> The echo \$_SERVER['REQUEST URI']; Give us : ";
    // echo $_SERVER['REQUEST_URI'];
    // echo "<br> The parse_url(\$_SERVER['REQUEST URI'], PHP_URL_PATH); Give us : ";
    // echo $router->uri;    
    // echo "</pre>";
    ?>
</body>

</html>

<!-- echo "<pre>";
    print_r($_SERVER);
    echo "</pre>"; -->