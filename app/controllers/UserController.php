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
    // this private $con is defined inside this class has nothing to do with the $con that is in the mysqlconnect.php file
    private $con;
    public function __construct()
    {
        // global $con is the $con that is in the mysqlconnect.php file
        global $con;
        $this->con = $con;
    }

    function home()
    {
        require_once('app/views/home.php');
    }
    function create()
    {
        // This code will be excuted when we press Submit
        // The isset here basicly look if the Superglobal $_POST is created. (check home.php)
        if (isset($_POST["submit"])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            //Since we are in a class now we have to instatiate the class UserModel in order to have createUser() function working.
            $store = new UserModel;
            $errorMsg = $store->createUser($this->con, $first_name, $last_name, $email);
            if ($errorMsg === "") require_once('app/views/success.php');
            else require_once('app/views/home.php');
            setcookie("FirstName",$first_name,time()+10,"/");
        }
    }
}
