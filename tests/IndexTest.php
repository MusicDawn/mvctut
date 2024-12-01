<?php
//First Test Case
//Here we start our TEST with PHPUnit in this case we will check if the connection to out databese works.

// We do that so we don't have to wirte all this (PHPUnit\Framework\TestCase;) in our class extend point.
use PHPUnit\Framework\TestCase;


//We set up a phpunit test by setting it up as a class
class IndexTest extends TestCase
{
    private $con;
    protected function setUp(): void
    {
        $this->con = new mysqli("localhost", "panos", "", "mvctut");
    }

    // The word test... on function's name is a must
    public function testConnection() 
    {
        // if ($this->con->errno===0) $result = true; the line below means this so basicly the $result is a bool.
        $result = $this->con->errno === 0;
        // assert.... are method that are used in phpunit for testing.
        $this->assertTrue($result);
    }

    // This function is commented out because phpunit is fucked up when we have headers.
    // public function testIndexOutput(): void
    // {
    //     // Ob = Output Buffer 
    //     ob_start();
    //     require("index.php");
    //     $contents = ob_get_contents();
    //     ob_end_clean();

    //     $this->assertStringContainsString('<div class="box">', $contents);
    // }

    protected function tearDown(): void
    {
        $this->con->close();
    }
}