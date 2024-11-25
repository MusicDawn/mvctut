<!-- Index is the cenral meeting point for all of our code!! -->
<?php
require_once('env.php');
require_once('mysqlconnect.php');
require_once('models/UserModel.php');
require_once('controllers/UserController.php');
create($con); // the funtion create($con) is defined in UserController.php
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
    <?php
    // We change the header location [if ($statement->execute()...] to index.php and we from now on we go to 'success.php' from those ifs.
    if($_SERVER['REQUEST_URI']=="/index.php") success(); // the funtion success is defined in UserController.php
    else require_once('views/home.php');


    //This is so we can see at the bottom of the page the $_SERVER['REQUEST_METHOD'] && $_SERVER['REQUEST_URI'].
    echo '<pre style="position: absolute; bottom :0; left: 5px;" >';
    echo ' Method ';
    print_r($_SERVER['REQUEST_METHOD']);
    echo '<br><br> URI : ';
    print_r($_SERVER['REQUEST_URI']);
    echo '</pre>';
    ?>
</body>

</html>