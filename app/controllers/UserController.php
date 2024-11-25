<?php

// Those 2 must be outside of the scope of if(....."submit") and we have 2 of them because ther are 2 error 
// 1) "Your email is already being used
// 2) "Your email is required!
$errorbool1 = false;
$errorbool2 = false;

class UserController
{
    function create($con)
    {
        // This code will be excuted when we press Submit
        if (isset($_POST["submit"])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            //Since we are in a class now we have to instatiate the class UserModel in order to have createUser() function working.
            $store = new UserModel;
            $store->createUser($con, $first_name, $last_name, $email);
        }
    }

    function success()
    {
        require_once('app/views/success.php');
    }
}
?>