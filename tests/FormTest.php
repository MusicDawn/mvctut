<?php

use PHPUnit\Framework\TestCase;
//We set up a phpunit test by setting it up as a class
class FormTest extends TestCase
{
    private $con;
    protected function setUp(): void
    {
        $this->con = new mysqli("localhost", "panos", "", "mvctut");
    }

    public function testFormSubmission()
    {
        $_POST = [
            "first_name" => "Panos",
            "last_name" => "Kwstakis",
            "email" => "panos@gmail.com",
            "submit" => "Submit"
        ];

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

        $query = "INSERT INTO `users` (`first_name` , `last_name` , `email`) VALUES (? , ? , ?)";

        $statement = $this->con->prepare($query);

        $statement->bind_param("sss", $first_name, $last_name, $email);

        //You set up the ending as a variable and  then you make the assertTrue so we know that it is correct ??
        $result = ($statement->execute());
        $this->assertTrue($result);
    }

    public function testForDuplicateEmail()
    {
        $_POST = [
            "first_name" => "Panos",
            "last_name" => "Kwstakis",
            "email" => "panos@gmail.com",
            "submit" => "Submit"
        ];

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

        $query = "INSERT INTO `users` (`first_name` , `last_name` , `email`) VALUES (? , ? , ?)";

        $statement = $this->con->prepare($query);

        $statement->bind_param("sss", $first_name, $last_name, $email);

        //You set up the ending as a variable and  then you make the assertTrue so we know that it is correct ??
        $result = ($statement->execute());
        $this->assertFalse($result);
        $this->deleteRow();
    }

    // Instead of tearDown we use another method which is deleteRow (from the database) so the test can work.
    public function deleteRow()  
    {
        $query = "DELETE FROM users WHERE email = 'panos@gmail.com'";
        $this->con->query($query);
    }
}