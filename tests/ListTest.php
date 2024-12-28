<?php

use PhpParser\Node\Stmt\Foreach_;
use PHPUnit\Framework\TestCase;

class ListTest extends TestCase
{
    private $con;
    protected function setUp(): void
    {
        $this->con = new mysqli("localhost", "panos", "", "mvctut");
        $this->createPanosKim();
    }

        private function createPanosKim()
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

        $statement->execute();
    }

    public function testListMethodResult()
    {
        $sql = "SELECT * FROM users";
        $result = $this->con->query($sql);
        $this->assertInstanceOf('mysqli_result', $result);
    }

    public function testListMethodContentSql()
    {
        // $this->createPanosKim(); This is commented out because we used it in setUp function!
        $sql = "SELECT * FROM users ORDER BY id desc";
        $result = $this->con->query($sql);
        $row = $result->fetch_assoc();
        $this->assertEquals('Panos', $row['first_name']);
    }

    public function testListMethodContentWhile()
    {
        // $this->createPanosKim(); This is commented out because we used it in setUp function!
        $sql = "SELECT * FROM users";
        $result = $this->con->query($sql);
        $lastrow = NULL;
        while ($row = $result->fetch_assoc()) {
            $lastrow = $row['first_name'];
        };
        $this->assertEquals('Panos', $lastrow);
    }

    public function testListMethodContentFetchAllForEach()
    {
        // $this->createPanosKim(); This is commented out because we used it in setUp function!
        $sql = "SELECT * FROM users";
        $result = $this->con->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $lastrow=NULL;
        foreach ($rows as $row)$lastrow=$row['first_name'];
        $this->assertEquals('Panos', $lastrow);
    }

    

    public function testListMethodContentFetchAllEnd()
    {
        // $this->createPanosKim(); This is commented out because we used it in setUp function!
        $sql = "SELECT * FROM users";
        $result = $this->con->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $last=end($rows);
        $this->assertEquals('Panos', $last['first_name']);
    }

    public function deleteRow()
    {
        $query = "DELETE FROM users WHERE email = 'panos@kim.gr'";
        $this->con->query($query);
    }

    protected function tearDown(): void
    {
        $this->deleteRow();
        $this->con->close();
    }
}
