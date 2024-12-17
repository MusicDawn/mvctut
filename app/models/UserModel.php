<?php
// Model only takes care of what goes into the Database.
namespace UserModelNamespace;

use Exception;

use function PHPUnit\Framework\throwException;

use mysqli_stmt;

class UserModel
{
    // The &$errorMsg is a Parameter by referance and it gets defined inside the function createUser()
    function createUser($con, $first_name, $last_name, $email)
    {
        // On valued insteasd of '$first_name' , '$last_name' , '$email' we use ? , ? , ? since on $statement->bind_param we use them
        $query = "INSERT INTO `users` (`first_name` , `last_name` , `email`) VALUES (? , ? , ?)";

        $statement = $con->prepare($query);
        //$statement = new mysqli_stmt; This happens automaticly from the pre-defined prepare method!!
        //bind_param Method uses the "sss" !3 strings! if we want to sanitize int we use i, d for float, d for blob.
        $statement->bind_param("sss", $first_name, $last_name, $email);

        // In try - throw - catch we use the Exception class. IN THIS CASE since we want to catch 2 exceptions we made 2 php file in app/models.
        // Those are DuplicateEmail.php && EmptyEmailField.php in which we extend Exception class with our 2 classes 1)DuplicateEmail 2) EmptyEmailField

        try {
            if ($statement->execute()) $errorMsg = "";
            else
                switch ($con->errno) {
                    case 1062;
                        throw new DuplicateEmail("Your email is already being used!");
                    case 3819;
                        throw new EmptyEmailField("You must have an email nerd!");
                }
        } catch (DuplicateEmail $e) {
            $errorMsg = $e->getMessage();
        } catch (EmptyEmailField $e) {
            $errorMsg = $e->getMessage();
        }
        return $errorMsg;
    }
}

