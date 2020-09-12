<?php
require_once "services/get_argument_value.php";
use PHPUnit\Framework\TestCase;

class GetArgumentValueTest extends TestCase
{
    private $argv = ["user_upload.php", "--file", "users.csv", "-h", "127.0.0.1", "-u", "postgres", "-p"];

    /**
     * Test Get Argument Value for file
     * @test
     */
    public function test_argument_value_file() {
        $this->assertEquals("users.csv", get_argument_value("--file", $this->argv));
    }

    /**
     * Test Get Argument Value for host
     * @test
     */
    public function test_argument_value_host() {
        $this->assertEquals("127.0.0.1", get_argument_value("-h", $this->argv));
    }

    /**
     * Test Get Argument Value for username
     * @test
     */
    public function test_argument_value_username() {
        $this->assertEquals("postgres", get_argument_value("-u", $this->argv));
    }

    /**
     * Test Get Argument Value for password
     * @test
     */
    public function test_argument_value_password() {
        $this->assertEquals("", get_argument_value("-p", $this->argv));
    }
}
