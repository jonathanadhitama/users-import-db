<?php

require_once "services/validate_username_password_host.php";
use PHPUnit\Framework\TestCase;

class ValidateUsernamePasswordHostTest extends TestCase
{
    private $valid_argv = ["user_upload.php", "--file", "users.csv", "-h", "127.0.0.1", "-u", "postgres", "-p"];
    private $invalid_argv_host = ["user_upload.php", "--file", "users.csv", "-u", "postgres", "-p"];
    private $invalid_argv_username = ["user_upload.php", "--file", "users.csv", "-h", "127.0.0.1", "-p"];
    private $invalid_argv_password = ["user_upload.php", "--file", "users.csv", "-h", "127.0.0.1", "-u", "postgres"];
    private $invalid_argv_all = ["user_upload.php", "--file", "users.csv"];

    /**
     * Test for valid argv
     * @test
     */
    public function test_valid_argv() {
        $validation = validate_username_password_host($this->valid_argv);
        $this->assertEquals(true, $validation["valid"]);
        $this->assertEquals("", $validation["message"]);
    }

    /**
     * Test for invalid argv host
     * @test
     */
    public function test_invalid_argv_host() {
        $validation = validate_username_password_host($this->invalid_argv_host);
        $this->assertEquals(false, $validation["valid"]);
        $this->assertEquals("Please provide the -h command option to specify the database username to insert user into DB", $validation["message"]);
    }

    /**
     * Test for invalid argv username
     * @test
     */
    public function test_invalid_argv_username() {
        $validation = validate_username_password_host($this->invalid_argv_username);
        $this->assertEquals(false, $validation["valid"]);
        $this->assertEquals(
            "Please provide the -u command option to specify the database username to insert user into DB",
            $validation["message"]
        );
    }

    /**
     * Test for invalid argv password
     * @test
     */
    public function test_invalid_argv_password() {
        $validation = validate_username_password_host($this->invalid_argv_password);
        $this->assertEquals(false, $validation["valid"]);
        $this->assertEquals(
            "Please provide the -p command option to specify the database username to insert user into DB",
            $validation["message"]
        );
    }

    /**
     * Test for all invalid argv
     * @test
     */
    public function test_invalid_argv_all() {
        $validation = validate_username_password_host($this->invalid_argv_all);
        $this->assertEquals(false, $validation["valid"]);
        $this->assertEquals("Please provide the -u command option to specify the database username to insert user into DB\nPlease provide the -h command option to specify the database username to insert user into DB\nPlease provide the -p command option to specify the database username to insert user into DB",
            $validation["message"]
        );
    }
}