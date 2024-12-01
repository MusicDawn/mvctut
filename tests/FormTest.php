<?php

use PHPUnit\Framework\TestCase;
use UserModelNamespace\UserModel;

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
            "email" => "panos@kim.gr",
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
        $this->assertTrue($result, "If this test has failed, delete entry in Database!");
    }

    public function testForDuplicateEmail()
    {
        $_POST = [
            "first_name" => "Panos",
            "last_name" => "Kwstakis",
            "email" => "panos@kim.gr",
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
        $this->assertFalse($result, "If this test has failed, delete entry in Database!");
        $this->deleteRow();
    }


    public function testFormSubmissionFunc()
    {
        $query = new UserModel;
        $result = $query->createUser($this->con, 'panos', 'kostakis', 'panos@kim.gr');
        // Since createUser returns 0; we have to use the method assertEquals.
        $this->assertEquals(0, $result, "If this test has failed, delete entry in Database!");
    }

    public function testForDuplicateEmailFunc()
    {
        $query = new UserModel;
        $result = $query->createUser($this->con, 'panos', 'kostakis', 'panos@kim.gr');
        // Since createUser returns 1062; (since we have duplicate email) we have to use the method assertEquals.
        $this->assertEquals(1062, $result, "If this test has failed, delete entry in Database!");
        $this->deleteRow();
    }


    // Instead of tearDown we use another method which is deleteRow (from the database) so the test can work.
    public function deleteRow()
    {
        $query = "DELETE FROM users WHERE email = 'panos@kim.gr'";
        $this->con->query($query);
    }

    public function testForEmptyEmailField()
    {
        $query = new UserModel;
        $result = $query->createUser($this->con, 'panos', 'kostakis', '');
        // Since createUser returns 3819; (since we have duplicate email) we have to use the method assertEquals.
        $this->assertEquals(3819, $result);
    }
}
