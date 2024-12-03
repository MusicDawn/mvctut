<?php
// Model only takes care of what goes into the Database.
namespace UserModelNamespace;

use Exception;

use function PHPUnit\Framework\throwException;

use mysqli_stmt;

class UserModel
{
    function createUser($con, $first_name, $last_name, $email)
    {
        // Here we excecute the querry so whatever we write into our form will go into database.
        // On valued insteasd of '$first_name' , '$last_name' , '$email' we use ? , ? , ? since on $statement->bind_param we use them
        $query = "INSERT INTO `users` (`first_name` , `last_name` , `email`) VALUES (? , ? , ?)";

        //Since we using migration.php file we have to use the METHOD multy_query($....) to our $con so we instead of $con->query($query); we have -->
        //Although like this we are not protected since someone can write code in out inputs and for example he can delete our table `users`.
        // $con->multi_query($query);

        //Here we using prepare / bind_param / excecute so we protect our inputs.
        //We start with prepare Method.
        $statement = $con->prepare($query);
        //Then with bind_param Method we use the "sss" since we want to sanitize 3 strings if we want to sanitize int we use i, d for float, d for blob.
        $statement->bind_param("sss", $first_name, $last_name, $email);



        // Lastly we excecute

        //!!!!! THIS IS A TERNARY is like a condensed version of an if-else statement and the syntax is **(condition) ? (value_if_true) : (value_if_false);**!!!!!!!!!!
        // return $statement->execute() ? 0 : $con->errno;

        // if($statement->execute())return 0; else return $con->errno  

        // In try - throw - catch we use the Exception class. IN THIS CASE since we want to catch 2 exceptions we made 2 php file in app/models.
        // Those are DuplicateEmail.php && EmptyEmailField.php in which we extend Exception class with our 2 classes 1)DuplicateEmail 2) EmptyEmailField

        try {
            if ($statement->execute()) return 0;
            else
                switch ($con->errno) {
                    case 0:
                        return 0;
                        break;
                    case 1062;
                        throw new DuplicateEmail;
                    case 3819;
                        throw new EmptyEmailField;
                }
        } catch (DuplicateEmail $e) {
            return 1062;
        } catch (EmptyEmailField $e) {
            return 3819;
        }
    }
}
