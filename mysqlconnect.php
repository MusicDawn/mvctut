<?php
require_once('env.php');
// Try-Throw-Catch is used to facilitate debugging.
try {
    // Here we connect to our database that we created in ep 3 in table plus, the passward should be empty in our case.
    // Because we haven't put anything in it, if we put then the Try-Throw-Catch will find it
    $con = new mysqli($host, $username, $password, $database);

    if ($con->connect_error) {
        throw new Exception('Error: ' . $con->connect_error);
    }
    //In the parenthesis Exception $ex we basicly instatiating $ex since it is a Typehint.
} catch (Exception $ex) {
    // We created a file in VANILLA error.log and below with those parameters we send the error text there
    error_log($ex->getMessage(), 3, 'error.log');
    echo "Can't connect at the momment!";
}