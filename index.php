<!-- Index is the central meeting point for all of our code!! -->
<?php
require_once('env.php');
require_once('mysqlconnect.php');
require_once('app/models/UserModel.php');
require_once('app/controllers/UserController.php');

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
    // Those are our Routes
    if ($_SERVER['REQUEST_URI'] == "/") {
        //We instatiating so we can use the function home() which is inside UserController class.
        $home = new UserController;
        $home->home();

    } else if ($_SERVER['REQUEST_URI'] == "/index.php" && $_SERVER['REQUEST_METHOD'] == 'POST') {
        //We instatiating so we can use the function create() which is inside UserController class.
        $creator = new UserController;
        $creator->create($con);
    } else if ($_SERVER["REQUEST_URI"] == "/index.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        //We instatiating so we can use the function success() which is inside RegisterSuccess class.
        $success = new RegisterSuccess;
        $success->success();
    }
    if ($errorbool1){
        $home = new UserController;
        $home->home();
    }
    ?>

    <!-- This is so we can see at the bottom of the page the $_SERVER['REQUEST_METHOD'] && $_SERVER['REQUEST_URI']. -->
    <pre style="position: absolute; bottom :0; left: 5px;">
    <?php var_dump($errorbool1); ?>
    <br>
     Method : <?php echo ($_SERVER['REQUEST_METHOD']); ?>
     <br>
     URI :<?php echo ($_SERVER['REQUEST_URI']); ?>       
    </pre>
</body>

</html>