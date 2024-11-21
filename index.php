<!-- Index is the cenral meeting point for all of our code!! -->
<?php
require_once('env.php');
require_once('mysqlconnect.php');
require_once('models/UserModel.php');
require_once('controllers/UserController.php');
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
    <?php require_once('views/home.php'); ?>
</body>

</html>