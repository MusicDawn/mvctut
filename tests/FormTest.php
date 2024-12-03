<?php

use PHPUnit\Framework\TestCase;
use UserModelNamespace\UserModel;

use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\once;

//We set up a phpunit test by setting it up as a class!
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

        //You set up the ending as a variable and then you make the assertTrue so we know that it is correct.
        // "If this test has failed, delete entry in Database!" This message will appear in Terminal so the other Devs should know what i going on.
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




    //----------- Those are Mock tests and we are testing our code, regardless of the database.
    // Basicly we mocking (pretending) that we have a database so we can test our code!
    // In order this to work we have to Adjust UserModel from $statement->execute(); return $con->errno;
    //to return $statement->execute(); // return $con->errno;
    public function testFormSubmissionMock()
    {
        $con = $this->createMock(mysqli::class);
        $stmt = $this->createMock(mysqli_stmt::class);
        $first_name = "panos";
        $last_name = "kostakis";
        $email = "panos@kim.gr";
        $query = "INSERT INTO `users` (`first_name` , `last_name` , `email`) VALUES (? , ? , ?)";
        $con->expects($this->once())
            ->method('prepare')
            ->with($query)
            ->willReturn($stmt);
        $stmt->expects($this->once())
            ->method('bind_param')
            ->with("sss", $first_name, $last_name, $email)
            ->willReturn(true);
        $stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $sql = new UserModel;
        $result = $sql->createUser($con, 'panos', 'kostakis', 'panos@kim.gr');
        $this->assertEquals(0 , $result, "If this test has failed, You suck ass :)))!");
    }





    //----------- Those 2 Integration Tests check if the code in UserModel does what is sopused to do!
    public function testFormSubmissionIntegration()
    {
        $query = new UserModel;
        $result = $query->createUser($this->con, 'panos', 'kostakis', 'panos@kim.gr');
        // Since createUser returns 0; we have to use the method assertEquals.
        $this->assertEquals(0, $result, "If this test has failed, delete entry in Database!");
    }

    public function testForDuplicateEmailIntegration()
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
