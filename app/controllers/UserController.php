<?php
//A PHP controller handles requests, validates input, delegates business logic to models or services, prepares data for views, and sends appropriate responses

//Namespaces are defined in composer.json
namespace UserControllerSpace;

use UserModelNamespace\UserModel;

$errorbool1 = false;
$errorbool2 = false;
// Those 2 must be outside of the scope of if(....."submit") and we have 2 of them because ther are 2 error 
// 1) "Your email is already being used
// 2) "Your email is required!


class UserController
{
    function home()
    {
        require_once('app/views/home.php');
    }
    function create($con)
    {
        // This code will be excuted when we press Submit
        if (isset($_POST["submit"])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            //Since we are in a class now we have to instatiate the class UserModel in order to have createUser() function working.
            $store = new UserModel;
            $result = $store->createUser($con, $first_name, $last_name, $email);

            switch ($result) {
                case 0:
                    require_once('app/views/success.php');
                    break;
                case 1062:
                    $error =  '<div style = "color: red" >Your email is already being used!</div> <br> <br>';
                    require_once('app/views/home.php');
                    break;
                case 3819;
                    $error =  '<div style = "color: red" >You must write your email!</div> <br> <br>';
                    require_once('app/views/home.php');
                    break;
            }
        }
    }
}